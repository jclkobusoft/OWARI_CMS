-- ============================================================
-- Tabla: productos_busqueda
-- Reemplaza la vista materializada mv_productos_busqueda.
-- Es una tabla regular que se actualiza incrementalmente
-- (solo los productos que cambian), no requiere REFRESH completo.
--
-- UNA FILA POR PRODUCTO x APLICACION VEHICULAR
-- Garantiza que buscar "chevy 2001" no de falsos positivos
-- con aplicaciones de otros vehiculos del mismo producto.
--
-- Campos:
-- - buscador: TEXT con toda la info concatenada (para LIKE)
-- - buscador_ts: tsvector del mismo texto (para full-text search)
-- - Campos de filtro vehicular para queries por filtro
-- - Campos de ordenamiento (ventas)
-- ============================================================

DROP TABLE IF EXISTS productos_busqueda;

CREATE TABLE productos_busqueda (
    id bigserial PRIMARY KEY,
    producto_id bigint NOT NULL,
    aplicacion_id bigint,

    -- Filtros vehiculares (necesarios para query tipo 'filtro')
    armadora varchar(255),
    modelo varchar(255),
    ano_inicial integer,
    ano_final integer,
    motor varchar(255),

    -- Filtros de categoria
    grupo varchar(255),
    subgrupo varchar(255),

    -- Flags
    nuevo boolean DEFAULT false,
    pagina_principal boolean DEFAULT false,

    -- Ordenamiento
    ventas integer DEFAULT 0,

    -- Busqueda: texto plano para LIKE y tsvector para full-text
    buscador text NOT NULL DEFAULT '',
    buscador_ts tsvector
);

-- ============================================================
-- INDICES
-- ============================================================

-- Full-text search (el mas importante)
CREATE INDEX idx_pb_buscador_ts ON productos_busqueda USING GIN (buscador_ts);

-- LIKE queries (trigram para busquedas parciales)
CREATE EXTENSION IF NOT EXISTS pg_trgm;
CREATE INDEX idx_pb_buscador_trgm ON productos_busqueda USING GIN (buscador gin_trgm_ops);

-- Busquedas por producto
CREATE INDEX idx_pb_producto_id ON productos_busqueda (producto_id);

-- Filtros vehiculares
CREATE INDEX idx_pb_armadora ON productos_busqueda (armadora);
CREATE INDEX idx_pb_modelo ON productos_busqueda (modelo);
CREATE INDEX idx_pb_ano ON productos_busqueda (ano_inicial, ano_final);

-- Filtros de categoria
CREATE INDEX idx_pb_subgrupo ON productos_busqueda (subgrupo);
CREATE INDEX idx_pb_grupo ON productos_busqueda (grupo);

-- Flags (parciales)
CREATE INDEX idx_pb_nuevo ON productos_busqueda (nuevo) WHERE nuevo = true;
CREATE INDEX idx_pb_pagina ON productos_busqueda (pagina_principal) WHERE pagina_principal = true;

-- Ordenamiento
CREATE INDEX idx_pb_ventas ON productos_busqueda (ventas DESC NULLS LAST);


-- ============================================================
-- POBLADO INICIAL (ejecutar una sola vez)
-- Despues de esto, la tabla se actualiza incrementalmente.
-- ============================================================
INSERT INTO productos_busqueda (
    producto_id, aplicacion_id,
    armadora, modelo, ano_inicial, ano_final, motor,
    grupo, subgrupo, nuevo, pagina_principal, ventas,
    buscador, buscador_ts
)
SELECT
    p.id as producto_id,
    pa.id as aplicacion_id,
    pa.armadora,
    pa.modelo,
    pa.ano_inicio as ano_inicial,
    pa.ano_fin as ano_final,
    pa.motor,
    pw.grupo,
    pw.subgrupo,
    COALESCE(pw.nuevo, false),
    COALESCE(pw.mostrar_pagina_principal, false),
    COALESCE(p.prioridad, 0),
    -- buscador: texto plano concatenado
    CONCAT_WS(' ',
        COALESCE(p.clave, ''),
        COALESCE(REPLACE(p.clave, '-', ''), ''),
        COALESCE(p.descripcion, ''),
        COALESCE(pw.descripcion_1, ''),
        COALESCE(pw.descripcion_2, ''),
        COALESCE(pw.descripcion_3, ''),
        COALESCE(pw.caracteristicas_1, ''),
        COALESCE(pw.caracteristicas_2, ''),
        COALESCE(pw.caracteristicas_3, ''),
        COALESCE(pw.caracteristicas_4, ''),
        COALESCE(m.nombre, ''),
        COALESCE(pw.grupo, ''),
        COALESCE(pw.subgrupo, ''),
        COALESCE(pw.oem, ''),
        COALESCE(pa.armadora, ''),
        COALESCE(pa.modelo, ''),
        COALESCE(pa.version, ''),
        COALESCE(pa.motor, ''),
        COALESCE(pa.generacion_mexico, ''),
        CASE
            WHEN pa.ano_inicio IS NOT NULL AND pa.ano_fin IS NOT NULL
                 AND pa.ano_fin >= pa.ano_inicio
                 AND (pa.ano_fin - pa.ano_inicio) <= 100
            THEN COALESCE((SELECT string_agg(y::text, ' ') FROM generate_series(pa.ano_inicio, pa.ano_fin) y), '')
            ELSE COALESCE(pa.ano_inicio::text, '') || ' ' || COALESCE(pa.ano_fin::text, '')
        END,
        COALESCE((SELECT string_agg(pe.clave, ' ') FROM productos_equivalencias pe WHERE pe.id_producto = p.id AND pe.deleted_at IS NULL), '')
    ),
    -- buscador_ts: tsvector del mismo texto
    to_tsvector('simple',
        CONCAT_WS(' ',
            COALESCE(p.clave, ''),
            COALESCE(REPLACE(p.clave, '-', ''), ''),
            COALESCE(p.descripcion, ''),
            COALESCE(pw.descripcion_1, ''),
            COALESCE(pw.descripcion_2, ''),
            COALESCE(pw.descripcion_3, ''),
            COALESCE(pw.caracteristicas_1, ''),
            COALESCE(pw.caracteristicas_2, ''),
            COALESCE(pw.caracteristicas_3, ''),
            COALESCE(pw.caracteristicas_4, ''),
            COALESCE(m.nombre, ''),
            COALESCE(pw.grupo, ''),
            COALESCE(pw.subgrupo, ''),
            COALESCE(pw.oem, ''),
            COALESCE(pa.armadora, ''),
            COALESCE(pa.modelo, ''),
            COALESCE(pa.version, ''),
            COALESCE(pa.motor, ''),
            COALESCE(pa.generacion_mexico, ''),
            CASE
                WHEN pa.ano_inicio IS NOT NULL AND pa.ano_fin IS NOT NULL
                     AND pa.ano_fin >= pa.ano_inicio
                     AND (pa.ano_fin - pa.ano_inicio) <= 100
                THEN COALESCE((SELECT string_agg(y::text, ' ') FROM generate_series(pa.ano_inicio, pa.ano_fin) y), '')
                ELSE COALESCE(pa.ano_inicio::text, '') || ' ' || COALESCE(pa.ano_fin::text, '')
            END,
            COALESCE((SELECT string_agg(pe.clave, ' ') FROM productos_equivalencias pe WHERE pe.id_producto = p.id AND pe.deleted_at IS NULL), '')
        )
    )
FROM productos p
LEFT JOIN productos_web pw ON p.id = pw.id_producto AND pw.deleted_at IS NULL
LEFT JOIN marcas m ON p.id_marca = m.id AND m.deleted_at IS NULL
LEFT JOIN productos_aplicaciones pa ON p.id = pa.id_producto AND pa.deleted_at IS NULL
WHERE p.deleted_at IS NULL;


-- ============================================================
-- NOTA: La vista materializada mv_productos_busqueda puede
-- eliminarse despues de verificar que todo funciona:
-- DROP MATERIALIZED VIEW IF EXISTS mv_productos_busqueda;
-- ============================================================
