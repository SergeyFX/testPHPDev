<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Realty;

class RealtySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // File path to import
        $file = storage_path('app/private/property-data.csv');

        if (!file_exists($file)) {
            $this->command->error("CSV not found: $file");
            return;
        }

        $handle = fopen($file, "r");

        if ($handle) {
            // Skipping the title
            fgetcsv($handle);

            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                // Important! Name, Price, Bedrooms, Bathrooms, Storeys, Garages
                Realty::create([
                    'name'      => $data[0],
                    'price'     => $data[1],
                    'bedrooms'  => $data[2],
                    'bathrooms' => $data[3],
                    'storeys'   => $data[4],
                    'garages'   => $data[5],
                ]);
            }

            fclose($handle);

            $this->command->info('Data imported successfully!');

        } else {
            $this->command->error('Failed to open file.');
        }
    }
}
