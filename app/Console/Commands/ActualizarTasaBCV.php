<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ActualizarTasaBCV extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:actualizar-tasa-b-c-v';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Usaremos una API gratuita que suele reportar la tasa oficial o un pequeño scraping
    // Por seguridad, si la API falla, mantenemos la última tasa conocida.
    try {
        $response = \Http::get('https://pydolarvenezuela-api.vercel.app/api/v1/dollar?page=bcv');
        $tasa = $response->json()['monedas']['usd']['valor'];
        
        // Guardamos en un archivo de configuración o base de datos
        \DB::table('settings')->updateOrInsert(['key' => 'tasa_bcv'], ['value' => $tasa]);
        $this->info("Tasa actualizada a: $tasa");
    } catch (\Exception $e) {
        $this->error("No se pudo actualizar la tasa.");
    }
    }
}
