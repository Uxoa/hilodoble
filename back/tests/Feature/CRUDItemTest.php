<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Item;
use App\Models\User;



class CRUDItemTest extends TestCase
{
    use RefreshDatabase;
    
    public function test_listItemAppearInHomeView()
    {
        $this->withExceptionHandling();

        $items =Item::factory(2)->create();
        $item =$items[0];

        $response = $this->get('/');
        $response -> assertSee($item->name);

        $response->assertStatus(200)
                ->assertViewIs('home');
    }
    public function test_anItemCanBeshowed()
    {
        $this->withExceptionHandling();

        $item = Item::factory()->create();
        $this->assertCount(1, Item::all());

        $response = $this->get(route('showItem', $item->id));
        $response->assertSee($item->itemName);
        $response->assertStatus(200)
                ->assertViewIs('showItem');

    }
    public function test_canUpdateAnItem(){
        
        $this->withExceptionHandling();

        $item = Item::factory()->create();
        $this->assertCount(1, Item::all());

        $response = $this->patch(route('updateItem', $item->id),['itemName' => 'New itemName']);
        $this->assertEquals('New itemName', Item::first()->itemName);
    }

        /* public function test_anItemCanBeDeletedApi()
    {
        $item = factory(Item::class)->create();
        $response = $this->json('DELETE', 'api/items/{$item->id}');
        $response->assertStatus(200);
        $response->assertJson(['message' => 'El producto se ha eliminado correctamente']);
    }  */

    public function test_anItemCanBeDeleted()
    {
        $this->withoutExceptionHandling();

        $item = Item::factory()->create();
        $this->assertCount(1, Item::all());
    
        $response = $this->delete(route('deleteItem', $item->id));
        $this->assertCount(0, Item::all());

    }

    
    public function test_anItemCanBeCreated(){
        $this->withExceptionHandling();


        $userAdmin = User::factory()->create(['isAdmin' => true]);
        $this->actingAs($userAdmin);

        $item = Item::factory()->create([
            'id' => $userAdmin->id
        ]);

        $response = $this
            ->actingAs($userAdmin)
            ->get(route('store', $item));

        $response->assertOk();


}

}

