<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Services\ReportingService;
use App\Services\DocumentService;
use App\Services\SuboperativeDocumentService;
use App\Services\TrainingService;
use App\Services\PeopleService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use App\Http\Requests\UserRequest;

class ReportingController extends Controller
{

    function __construct(ReportingService $service)
    {
        $this->service = $service;
    }

    public function dashboardStats()
    {
        $peopleStats = $this->service->peopleStats();
        $suboperativeStats = $this->service->suboperativeStats();
        $skillStats = $this->service->skillStats();
        $trainingStats = $this->service->trainingStats();
        $projectStatus = $this->service->projectStats();
        $subcontractorStats = $this->service->subcontractorStats();

            return response()->json([
                'suboperative_stats' => $suboperativeStats,
                'people_stats' => $peopleStats,
                'skills_stats' => $skillStats,
                'training_stats' => $trainingStats,
                'project_stats' => $projectStatus,
                'subcontractor_stats' => $subcontractorStats,
                'status' => 'success',
                'code' => 200,
                'message' => 'document fetched'
            ], 200);

    }

    public function showDashboard()
    {

        if(Auth::user()->getRoleNames()[0] == 'owner')
        {
            $statusCounts = $this->service->companyStatusCount();

            return view('backend.reporting.owner-dashboard', ['status_counts' => $statusCounts]);

        }
        else
        {
            $trainingService = new TrainingService;

            
            $docService = new DocumentService;
            $subopDocService = new SuboperativeDocumentService;
            $peopleService = new PeopleService;

            $documents = $docService->getDocByStatus(['Critical', 'Expiring']);
            $subopDocuments = $subopDocService->getExpiredAssignedSkills();







            $trainings = $trainingService->getTrainingsByStatus('Active');
            $holidays = $peopleService->getNearHolidays();

            $title = \Lang::get('site.dashboard_page_title');

            return view('backend.reporting.dashboard', ['title' => $title, 'documents' => $documents, 'holidays' => $holidays, 'trainings' => $trainings,'subop_documents' => $subopDocuments]);

        }




    }




}
