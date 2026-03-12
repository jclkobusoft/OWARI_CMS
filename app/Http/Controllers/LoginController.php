<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class LoginController extends Controller
{
    //
    public function index()
    {
        //
        if(Auth::check())
            return redirect()->route('inicio');
        return view('login');
    }

    public  function login(Request $request){

        extract($request->all());

        if (Auth::attempt(['email' => $usuario, 'password' => $password],$request->exists('recordarme'))){
          	(new SistemaController)->accion([\Auth::user()->id,'inicio_sesion',1,'agregar','El usuario '.Auth::user()->name.' inicio sesion']);
            return redirect()->route('inicio');
        }
        else{

             \Session::flash('message', 'Los datos de usuario no coinciden. Verificalos');
             return redirect()->route('admin');
        }

    }

    public  function logout(){

        (new SistemaController)->accion([\Auth::user()->id,'inicio_sesion',1,'eliminar','El usuario '.Auth::user()->name.' termino la sesión']);
        Auth::logout();
        return redirect()->route('admin');

    }

    public function eliminarFotosMac(){

        $carpetas = [
            "32906433",
"30906265",
"51133031",
"51109243",
"51103601",
"51023704",
"51320SDAA05",
"306205600",
"904514BA0B",
"3492467",
"306109",
"654712943",
"68061369AA",
"51321SDAA05",
"68083885AA",
"36109675",
"68089034AD",
"90450JG40B",
"68121144",
"51360SWAA01",
"191853817A",
"191853717A",
"49001JR810",
"68919081",
"48903017",
"689500D022",
"689500R010",
"6896008010",
"36906051",
"2892050Y00",
"37105269",
"527501R000",
"37121619",
"904505RB0A",
"37122058",
"28903137",
"904504BA0B",
"28145271",
"280155925",
"279983851",
"313903MX0A",
"279980311",
"279195011",
"279190811",
"1H0412303",
"27911023",
"27905207",
"27903137",
"69105263",
"96666219",
"27145255",
"27145157",
"271156119",
"27109675",
"9114603",
"9115064",
"9115863",
"9117621",
"9117716",
"27105273",
"9119567",
"69121113",
"9120129",
"9128719",
"26906247",
"91301189",
"269061615",
"26905105",
"9158506",
"26145271",
"261231045",
"53011T0AA01C",
"06K103495AP",
"261211452",
"26121133",
"85311113",
"261210533",
"26109675",
"96808460",
"1701829",
"1J0612041GS",
"261052554",
"26105255",
"279980491",
"53011T0AA02C",
"KD5363620C",
"KD5362620C",
"481452551",
"4814200AF",
"48133455",
"481210311",
"48103772",
"F67Z16C826AA",
"48103601",
"8185052R00",
"25931541",
"04743S9A000",
"53103663",
"254019",
"07K103469L-VALV",
"15983922",
"15825422",
"58905105",
"15161943",
"803012252",
"149415211",
"143014672",
"07K129684B",
"377863293G",
"25192208",
"58260511",
"58198217",
"93262068",
"58121350",
"58121132",
"38103663",
"93289332-ALUM",
"38145276",
"58109244",
"58103213",
"580453966",
"580453509",
"38906461",
"134093992",
"133111131",
"5802A304",
"25183354",
"6L2Z78406A10AA",
"25121482",
"6Q0411314",
"24111395",
"1103905",
"CN15N400A12BA",
"22792759",
"55911023",
"032121111CL-AL",
"C23633060A",
"21907385",
"1301227",
"21905106",
"3B0512131H",
"78121006",
"7700842256",
"40105015",
"54905377",
"54903137",
"74906433",
"74820TLAA01",
"74820TK8306",
"74820TJ0M02",
"74820T7JH01",
"74820T5RA01",
"74820T1GE010",
"548300U000",
"74820SWAA01",
"74820SHJA01",
"74121438",
"74121132",
"1K6955651",
"1L5416C827AB",
"41115105",
"BB5Z78406A10A",
"95095591",
"20141182",
"20141733",
"20311108",
"20311113",
"94580182",
"70115311",
"94669484",
"6RU955453",
"44310S5DA01",
"43105245",
"211795023",
"211792023",
"113129031K",
"43919051",
"43905225",
"BN8V56930",
"211715023",
"06A133062Q",
        ];

        $directorio = storage_path('app/public/productos/');
        //$carpetas = scandir($directorio);
        foreach($carpetas as $key => $carpeta) {
            // code...
            if(is_dir($directorio.$carpeta)){
                echo $directorio.$carpeta."<br>";
                $fotos = scandir($directorio.$carpeta);
                foreach ($fotos as $llave => $foto) {
                    // code...
                    if($foto != '.' && $foto != '..'){
                        if(is_file($directorio.$carpeta."/".$foto)){
                            $eliminar_foto = $directorio.$carpeta."/".$foto;
                            unlink($eliminar_foto);
                        }
                    }
                }
            }
            
            echo "<br><br><br>";
        }

    }
}
