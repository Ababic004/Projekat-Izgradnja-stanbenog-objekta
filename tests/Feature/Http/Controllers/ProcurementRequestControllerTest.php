<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\ProcurementRequest;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\ProcurementRequestController
 */
final class ProcurementRequestControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_displays_view(): void
    {
        $procurementRequests = ProcurementRequest::factory()->count(3)->create();

        $response = $this->get(route('procurement-requests.index'));

        $response->assertOk();
        $response->assertViewIs('procurementRequest.index');
        $response->assertViewHas('procurementRequests', $procurementRequests);
    }


    #[Test]
    public function create_displays_view(): void
    {
        $response = $this->get(route('procurement-requests.create'));

        $response->assertOk();
        $response->assertViewIs('procurementRequest.create');
    }


    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\ProcurementRequestController::class,
            'store',
            \App\Http\Requests\ProcurementRequestControllerStoreRequest::class
        );
    }

    #[Test]
    public function store_saves_and_redirects(): void
    {
        $response = $this->post(route('procurement-requests.store'));

        $response->assertRedirect(route('procurementRequests.index'));
        $response->assertSessionHas('procurementRequest.id', $procurementRequest->id);

        $this->assertDatabaseHas(procurementRequests, [ /* ... */ ]);
    }


    #[Test]
    public function show_displays_view(): void
    {
        $procurementRequest = ProcurementRequest::factory()->create();

        $response = $this->get(route('procurement-requests.show', $procurementRequest));

        $response->assertOk();
        $response->assertViewIs('procurementRequest.show');
        $response->assertViewHas('procurementRequest', $procurementRequest);
    }


    #[Test]
    public function edit_displays_view(): void
    {
        $procurementRequest = ProcurementRequest::factory()->create();

        $response = $this->get(route('procurement-requests.edit', $procurementRequest));

        $response->assertOk();
        $response->assertViewIs('procurementRequest.edit');
        $response->assertViewHas('procurementRequest', $procurementRequest);
    }


    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\ProcurementRequestController::class,
            'update',
            \App\Http\Requests\ProcurementRequestControllerUpdateRequest::class
        );
    }

    #[Test]
    public function update_redirects(): void
    {
        $procurementRequest = ProcurementRequest::factory()->create();

        $response = $this->put(route('procurement-requests.update', $procurementRequest));

        $procurementRequest->refresh();

        $response->assertRedirect(route('procurementRequests.index'));
        $response->assertSessionHas('procurementRequest.id', $procurementRequest->id);
    }


    #[Test]
    public function destroy_deletes_and_redirects(): void
    {
        $procurementRequest = ProcurementRequest::factory()->create();

        $response = $this->delete(route('procurement-requests.destroy', $procurementRequest));

        $response->assertRedirect(route('procurementRequests.index'));

        $this->assertModelMissing($procurementRequest);
    }
}
