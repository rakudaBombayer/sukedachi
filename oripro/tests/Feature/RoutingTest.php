<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RoutingTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_requests_page_is_accessible(): void
{
    $response = $this->get(route('requests.create'));

    $response->assertStatus(200);
    $response->assertSee('投稿'); // 表示されるキーワードを確認（任意）
    }
}