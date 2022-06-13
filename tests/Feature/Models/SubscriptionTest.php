<?php

namespace Tests\Feature\Models;

use App\Models\Gym;
use App\Models\Member;
use App\Models\Membership;
use App\Models\Subscription;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Carbon;
use Tests\TestCase;

class SubscriptionTest extends TestCase
{
    /**
     * API exists
     *
     * @return void
     */
    public function test_api_exits()
    {
        $response = $this->get(route('subscription.index'));

        $response->assertStatus(200);
    }

    /**
     * create new subscription
     */
    public function test_create_new_subscription()
    {
        $gym = Gym::factory()->create([
            'name' => 'GYMMY'
        ]);

        $member = Member::factory()->create();

        $membership = Membership::factory()->create();

        $subscription = [
            'member_id' => $member['id'],
            'membership_id' => $membership['id'],
            'started_at' => Carbon::now()->toDateString(),
            'expire_at' => Carbon::now()->addDays(30)->toDateString()
        ];

        $http_response_header = $this->post(route('subscription.store'), $subscription);

        $this->assertDatabaseHas('subscriptions', $subscription);
    }

    /**
     * validate new subscriptions
     */
    public function test_validate_new_subscriptions()
    {
        $subscription = [
            'member_id' => 3,
            'started_at' => Carbon::now()->toDateString(),
        ];

        $http_response_header = $this->post(route('subscription.store'), $subscription);

        $http_response_header->assertStatus(302);

        $this->assertDatabaseCount('subscriptions', 0);
    }

    /**
     * Fetch subscription
     */
    public function test_fetch_subscription()
    {
        $gym = Gym::factory()->create([
            'name' => 'GYMFetch'
        ]);

        $member = Member::factory()->create();

        $membership = Membership::factory()->create();

        $subscription = [
            'member_id' => $member['id'],
            'membership_id' => $membership['id'],
            'started_at' => Carbon::now()->toDateString(),
            'expire_at' => Carbon::now()->addDays(30)->toDateString()
        ];

        $response = $this->post(route('subscription.store'), $subscription);

        $http_response_header = $this->get(route('subscription.show', $response['id']));

        $http_response_header->assertJson($subscription);
    }

    /**
     * Fetch all subscription
     */
    public function test_fetch_all_subscriptions()
    {
        $gym = Gym::factory()->create([
            'name' => 'GYMFetchAll'
        ]);

        $member = Member::factory()->create();

        $membership = Membership::factory()->create();

        $subscription = [
            'member_id' => $member['id'],
            'membership_id' => $membership['id'],
            'started_at' => Carbon::now()->toDateString(),
            'expire_at' => Carbon::now()->addDays(30)->toDateString()
        ];

        $this->post(route('subscription.store'), $subscription);

        $http_response_header = $this->get(route('subscription.index'));

        $http_response_header->assertJson([$subscription]);
    }

    /**
     * update subscription
     */
    public function test_update_subscription(){
        $gym = Gym::factory()->create([
            'name' => 'GYMUpdate'
        ]);

        $member = Member::factory()->create();

        $membership = Membership::factory()->create();

        $subscription = Subscription::create([
            'member_id' => $member['id'],
            'membership_id' => $membership['id'],
            'started_at' => Carbon::now()->toDateString(),
            'expire_at' => Carbon::now()->addDays(30)->toDateString()
        ]);

        $http_response_header = $this->put(route('subscription.update',$subscription),[
            'expire_at' => Carbon::now()->addDays(60)->toDateString()
        ]);

        $this->assertDatabaseHas('subscriptions',[
            'expire_at' => Carbon::now()->addDays(60)->toDateString()
        ]);
    }

    /**
     * Delete a subscription
     */
    public function test_delete_a_subscription(){
        $gym = Gym::factory()->create([
            'name' => 'GYMDelete'
        ]);

        $member = Member::factory()->create();

        $membership = Membership::factory()->create();

        $subscription = Subscription::create([
            'member_id' => $member['id'],
            'membership_id' => $membership['id'],
            'started_at' => Carbon::now()->toDateString(),
            'expire_at' => Carbon::now()->addDays(30)->toDateString()
        ]);

        $this->delete(route('subscription.destroy',$subscription['id']));

        $this->assertDatabaseCount('subscriptions',0);
    }
}
