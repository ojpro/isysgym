<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreContactInformationRequest;
use App\Http\Requests\UpdateContactInformationRequest;
use App\Models\ContactInformation;

class ContactInformationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreContactInformationRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreContactInformationRequest $request)
    {
        // Handle Request validation
        $validated = $request->validated();

        // Store the contact information
        ContactInformation::create($request->all());

        // TODO: use lang (__) instead of writing the text here
        // return success message
        return response()->json(['success' => 'Information Added Successfully']);
    }

    /**
     * Display the specified resource.
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(int $id)
    {
        // search for the information
        $contact = ContactInformation::findOrFail($id);

        // return the founded object
        return response()->json($contact);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateContactInformationRequest $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateContactInformationRequest $request, int $id)
    {
        //TODO: validated all requests

        // search for the information
        $contact = ContactInformation::findOrFail($id);

        $contact->update($request->all());

        return response()->json(['success' => 'Information updated successfully']);
    }

    // TODO: remove relationships before destroy
    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(int $id)
    {
        // search for the information
        $contact = ContactInformation::findOrFail($id);

        // remove the object
        $contact->delete();

        // return success message
        return response()->json(['success' => 'Information deleted successfully']);

    }
}
