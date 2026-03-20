-- ============================================================
-- Vista materializada: mv_productos_busqueda
-- Replica la estructura de productos_busqueda (MySQL) pero
-- desde las tablas normalizadas de owari_soma (PostgreSQL).
--
-- UNA FILA POR PRODUCTO × APLICACIÓN VEHICULAR
-- Esto garantiza que al buscar "tsuru 1999" solo matchee
-- la fila donde la aplicación es TSURU y el rango de años
-- incluye 1999. No mezcla datos entre aplicaciones distintas.
--
-- El campo buscador (tsvector) incluye los años individuales
-- generados del rango ano_inicio-ano_fin de CADA aplicación.
-- ============================================================

DROP MATERIALIZED VIEW IF EXISTS mv_productos_busqueda;

CREATE MATERIALIZED VIEW mv_productos_busqueda AS
SELECT
    ROW_NUMBER() OVER () as row_id,
    p.id as producto_id,
    pa.id as aplicacion_id,

    -- Datos del producto
    m.nombre as marca_comercial,
    p.clave as codigo_nikko,
    pw.clave_simple as codigosinguiones,
    pw.grupo,
    pw.subgrupo,
    pw.descripcion_1,
    pw.descripcion_2,
    pw.descripcion_3,
    pw.caracteristicas_1,
    pw.caracteristicas_2,
    pw.caracteristicas_3,
    pw.caracteristicas_4,

    -- Equivalencias: NO se incluyen como columnas (pueden ser >10 por producto).
    -- TODAS las equivalencias están en el tsvector 'buscador' para búsqueda.
    -- Al visualizar, se obtienen por JOIN a productos_equivalencias.

    pw.oem,

    -- Aplicación vehicular (de ESTA fila específica)
    pa.armadora,
    pa.modelo,
    pa.ano_inicio as ano_inicial,
    pa.ano_fin as ano_final,
    pa.generacion_mexico,
    pa.version,
    pa.motor,
    pa.especificacion,

    -- Flags
    COALESCE(pw.nuevo, false) as nuevo,
    COALESCE(pw.mas_vendido, false) as vendido,
    COALESCE(pw.mostrar_pagina_principal, false) as pagina_principal,

    -- Precios y stock
    COALESCE((SELECT ppr.precio FROM productos_precios ppr WHERE ppr.id_producto = p.id AND ppr.id_lista_precios = 1 AND ppr.id_sucursal = 1 AND ppr.deleted_at IS NULL LIMIT 1), 0) as precio_normal,
    COALESCE(p.prioridad, 0) as ventas,
    COALESCE((SELECT SUM(ps.stock) FROM productos_stock ps WHERE ps.id_producto = p.id AND ps.deleted_at IS NULL), 0) as existencias,

    -- ============================================================
    -- BUSCADOR: tsvector con TODOS los datos de búsqueda
    -- Incluye datos del producto + datos de ESTA aplicación específica
    -- + los años individuales generados del rango ano_inicio-ano_fin
    -- + las equivalencias del producto
    -- ============================================================
    to_tsvector('simple',
        COALESCE(p.clave, '') || ' ' ||
        COALESCE(pw.clave_simple, '') || ' ' ||
        COALESCE(p.descripcion, '') || ' ' ||
        COALESCE(pw.descripcion_1, '') || ' ' ||
        COALESCE(pw.descripcion_2, '') || ' ' ||
        COALESCE(pw.descripcion_3, '') || ' ' ||
        COALESCE(pw.caracteristicas_1, '') || ' ' ||
        COALESCE(pw.caracteristicas_2, '') || ' ' ||
        COALESCE(pw.caracteristicas_3, '') || ' ' ||
        COALESCE(pw.caracteristicas_4, '') || ' ' ||
        COALESCE(m.nombre, '') || ' ' ||
        COALESCE(pw.grupo, '') || ' ' ||
        COALESCE(pw.subgrupo, '') || ' ' ||
        COALESCE(pw.oem, '') || ' ' ||
        COALESCE(pa.armadora, '') || ' ' ||
        COALESCE(pa.modelo, '') || ' ' ||
        COALESCE(pa.version, '') || ' ' ||
        COALESCE(pa.motor, '') || ' ' ||
        COALESCE(pa.generacion_mexico, '') || ' ' ||
        -- Años individuales: genera 1998 1999 2000 para rango 1998-2000
        CASE
            WHEN pa.ano_inicio IS NOT NULL AND pa.ano_fin IS NOT NULL
                 AND pa.ano_fin >= pa.ano_inicio
                 AND (pa.ano_fin - pa.ano_inicio) <= 100
            THEN COALESCE((SELECT string_agg(y::text, ' ') FROM generate_series(pa.ano_inicio, pa.ano_fin) y), '')
            ELSE COALESCE(pa.ano_inicio::text, '') || ' ' || COALESCE(pa.ano_fin::text, '')
        END || ' ' ||
        -- Equivalencias del producto
        COALESCE((SELECT string_agg(pe.clave, ' ') FROM productos_equivalencias pe WHERE pe.id_producto = p.id AND pe.deleted_at IS NULL), '')
    ) as buscador

FROM productos p
LEFT JOIN productos_web pw ON p.id = pw.id_producto AND pw.deleted_at IS NULL
LEFT JOIN marcas m ON p.id_marca = m.id AND m.deleted_at IS NULL
LEFT JOIN productos_aplicaciones pa ON p.id = pa.id_producto AND pa.deleted_at IS NULL
WHERE p.deleted_at IS NULL;

-- ============================================================
-- ÍNDICES
-- ============================================================

-- Unique para permitir REFRESH CONCURRENTLY (sin bloquear lecturas)
CREATE UNIQUE INDEX idx_mv_row_id ON mv_productos_busqueda (row_id);

-- Full-text search (el más importante)
CREATE INDEX idx_mv_buscador ON mv_productos_busqueda USING GIN (buscador);

-- Búsquedas por código de producto
CREATE INDEX idx_mv_codigo ON mv_productos_busqueda (codigo_nikko);

-- Búsquedas por categoría
CREATE INDEX idx_mv_subgrupo ON mv_productos_busqueda (subgrupo);
CREATE INDEX idx_mv_grupo ON mv_productos_busqueda (grupo);

-- Filtros vehiculares
CREATE INDEX idx_mv_armadora ON mv_productos_busqueda (armadora);
CREATE INDEX idx_mv_modelo ON mv_productos_busqueda (modelo);
CREATE INDEX idx_mv_ano ON mv_productos_busqueda (ano_inicial, ano_final);

-- Filtros de flags (parciales para mejor rendimiento)
CREATE INDEX idx_mv_nuevo ON mv_productos_busqueda (nuevo) WHERE nuevo = true;
CREATE INDEX idx_mv_pagina ON mv_productos_busqueda (pagina_principal) WHERE pagina_principal = true;

-- Ordenamiento por prioridad/ventas
CREATE INDEX idx_mv_ventas ON mv_productos_busqueda (ventas DESC NULLS LAST);


-- ============================================================
-- PARA REFRESCAR LA VISTA (ejecutar periódicamente via cron):
-- REFRESH MATERIALIZED VIEW CONCURRENTLY mv_productos_busqueda;
--
-- CONCURRENTLY permite que las lecturas sigan funcionando
-- mientras se refresca. Requiere el unique index idx_mv_row_id.
-- ============================================================
