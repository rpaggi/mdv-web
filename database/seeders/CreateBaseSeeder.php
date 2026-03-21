<?php

namespace Database\Seeders;

use App\Models\Exam;
use App\Models\Person;
use App\Models\Product;
use App\Models\Sell;
use App\Models\SellItem;
use App\Models\User;
use Illuminate\Database\Seeder;

class CreateBaseSeeder extends Seeder
{
    public function run()
    {
        if (app()->environment('production')) {
            return;
        }

        $agents = User::factory()->count(3)->create();
        foreach ($agents as $agent) {
            $agent->assignRole('agent');
        }

        $people = Person::factory()->count(15)->create();
        $products = Product::factory()->count(25)->create();

        for ($i = 0; $i < 20; $i++) {
            Exam::factory()->create([
                'person_id' => $people->random()->id,
                'agent_id' => $agents->random()->id,
            ]);
        }

        for ($i = 0; $i < 12; $i++) {
            $sell = Sell::factory()->create([
                'person_id' => $people->random()->id,
                'status' => 0,
            ]);

            $itemsCount = random_int(2, 4);
            for ($itemIndex = 0; $itemIndex < $itemsCount; $itemIndex++) {
                $product = Product::query()->where('quantity', '>', 0)->inRandomOrder()->first();

                if (! $product) {
                    break;
                }

                $quantity = min(random_int(1, 3), $product->quantity);
                if ($quantity <= 0) {
                    continue;
                }

                SellItem::factory()->create([
                    'sell_id' => $sell->id,
                    'product_id' => $product->id,
                    'quantity' => $quantity,
                    'value' => $product->value,
                    'discount' => 0,
                ]);

                $product->removeQuantity($quantity);
            }
        }
    }
}
