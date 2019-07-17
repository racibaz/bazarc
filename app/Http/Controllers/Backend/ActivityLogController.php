<?php /** @noinspection ALL */

namespace App\Http\Controllers\Backend;

use App\Contracts\Repositories\ActivityLogRepository;
use App\Models\ActivityLog;
use Illuminate\Http\Response;


class ActivityLogController extends BackendBaseController
{
    /**
     * @var ActivityLogRepository
     */
    protected $repository;

    public function __construct(ActivityLogRepository $repository)
    {
        $this->repository = $repository;

        $this->authorizeResource(ActivityLog::class, 'activity_log');
    }

    public function index()
    {
        $records = $this->repository->orderBy('created_at', 'desc')->all();

        if (\request()->ajax()) {
            return $this->datatableData($records);
        }

        return view('backend.activity_log.index', compact(['records']));
    }

    /**
     * Display the specified resource.
     *
     * @param $record
     *
     * @return Response
     * @internal param int $id
     */
    public function show($record)
    {
        return view('backend.activity_log.show', compact(['record']));
    }
}
