<?php

namespace Tests\Feature;
use Illuminate\Auth\Middleware\IsAdmin;
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
    public function test_AnItemCanBeUpdateJustByAnAdmin(){
        
        $this->withExceptionHandling();

        $item = Item::factory()->create();
        $this->assertCount(1, Item::all());

        $userAdmin = User::factory()->create(['isAdmin'=>true]);
        $this->actingAs($userAdmin);

        $response = $this->patch(route('updateItem', $item->id),['itemName' => 'New itemName']);
        $this->assertEquals('New itemName', Item::first()->itemName);

        $userNoAdmin = User::factory()->create(['isAdmin'=>false]);
        $this->actingAs($userNoAdmin);
        
        $response = $this->patch(route('updateItem', $item->id),['itemName' => 'Second itemName']);
        $this->assertEquals('New itemName', Item::first()->itemName);
    }  

    public function test_anItemCanBeDeleteJustByAnAdmin()
    {
        $this->withExceptionHandling();

        $item = Item::factory()->create();
        $this->assertCount(1, Item::all());

        $userNoAdmin=User::factory()->create(['isAdmin'=>false]);
        $this->actingAs($userNoAdmin);
    
        $response = $this->delete(route('deleteItem', $item->id));
        $this->assertCount(1, Item::all()); 
        $response->assertStatus(403); 


        $userAdmin = User::factory()->create(['isAdmin'=>true]);
        $this->actingAs($userAdmin);

        $response = $this->delete(route('deleteItem', $item->id));
        $this->assertCount(0, Item::all()); 


    }

    
    public function test_anItemCanBeCreatedJustByAnAdmin(){
        $this->withExceptionHandling();


        $userAdmin = User::factory()->create(['isAdmin' => true]);
        $this->actingAs($userAdmin);


        $response = $this ->post(route('store'),[
                'itemName'=> 'itemName',
                'category'=>'category',
                'description'=>'description',
                'image'=>'https://hilodoble.com/wp-content/uploads/2021/06/bolsaviaje_museum_3-300x300.jpg',
                'stockQuantity'=>'4',
                'purchaseQuantity'=>'5',
                'price'=>'14' 
            ]);

        $this->assertCount(1,Item::all());

        $userNoAdmin = User::factory()->create(['isAdmin' => false]);
        $this->actingAs($userNoAdmin); 

        $response = $this->post(route('store'),[
            'itemName'=> 'itemName',
            'category'=>'category',
            'description'=>'description',
            'image'=>'https://hilodoble.com/wp-content/uploads/2021/06/bolsaviaje_museum_3-300x300.jpg',
            'stockQuantity'=>'4',
            'purchaseQuantity'=>'5',
            'price'=>'4' 
        ]);

        $this->assertCount(1,Item::all()); 

}

}

