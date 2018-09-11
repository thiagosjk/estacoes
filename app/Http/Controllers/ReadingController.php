<?php

namespace App\Http\Controllers;

use App\DataTables\ReadingDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateReadingRequest;
use App\Http\Requests\UpdateReadingRequest;
use App\Repositories\ReadingRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;
use App\Models\Station;

class ReadingController extends AppBaseController
{
    /** @var  ReadingRepository */
    private $readingRepository;

    public function __construct(ReadingRepository $readingRepo)
    {
        $this->readingRepository = $readingRepo;
    }

    /**
     * Display a listing of the Reading.
     *
     * @param ReadingDataTable $readingDataTable
     * @return Response
     */
    public function index(ReadingDataTable $readingDataTable)
    {
        return $readingDataTable->render('readings.index');
    }

    /**
     * Show the form for creating a new Reading.
     *
     * @return Response
     */
    public function create()
    {
        $stations = Station::orderBy('name','asc')->pluck('name', 'id')->toArray();

        return view('readings.create', compact('stations'));
    }

    /**
     * Store a newly created Reading in storage.
     *
     * @param CreateReadingRequest $request
     *
     * @return Response
     */
    public function store(CreateReadingRequest $request)
    {
        $input = $request->all();

        $reading = $this->readingRepository->create($input);

        Flash::success('Reading saved successfully.');

        return redirect(route('readings.index'));
    }

    /**
     * Display the specified Reading.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $reading = $this->readingRepository->findWithoutFail($id);

        if (empty($reading)) {
            Flash::error('Reading not found');

            return redirect(route('readings.index'));
        }

        return view('readings.show')->with('reading', $reading);
    }

    /**
     * Show the form for editing the specified Reading.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $reading = $this->readingRepository->findWithoutFail($id);

        if (empty($reading)) {
            Flash::error('Reading not found');

            return redirect(route('readings.index'));
        }

        $stations = Station::orderBy('name','asc')->pluck('name', 'id')->toArray();


        return view('readings.edit', compact('reading', 'stations'));
    }

    /**
     * Update the specified Reading in storage.
     *
     * @param  int              $id
     * @param UpdateReadingRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateReadingRequest $request)
    {
        $reading = $this->readingRepository->findWithoutFail($id);

        if (empty($reading)) {
            Flash::error('Reading not found');

            return redirect(route('readings.index'));
        }

        $reading = $this->readingRepository->update($request->all(), $id);

        Flash::success('Reading updated successfully.');

        return redirect(route('readings.index'));
    }

    /**
     * Remove the specified Reading from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $reading = $this->readingRepository->findWithoutFail($id);

        if (empty($reading)) {
            Flash::error('Reading not found');

            return redirect(route('readings.index'));
        }

        $this->readingRepository->delete($id);

        Flash::success('Reading deleted successfully.');

        return redirect(route('readings.index'));
    }
}
