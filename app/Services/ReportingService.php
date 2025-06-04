<?php

namespace App\Services;

use Illuminate\Foundation\Http\Kernel as HttpKernel;
use Illuminate\Support\Facades\Auth;
use App\Models\Company;
use App\Models\Tenant;
use App\Models\People;
use App\Models\Suboperative;
use App\Models\TaskSuboperative;
use App\Models\Subcontractor;
use App\Models\Document;
use App\Models\Training;
use App\Models\Project;
use App\Models\ProjectAssignment;


use App\Library\Utility;

class ReportingService
{

    public function projectStats()
    {
        $stats = ['planning' => 0, 'active' => 0, 'complete' => 0];

        $stats['planning'] = Project::where('status', 'Planning')->count();
        $stats['active'] = Project::where('status', 'Active')->count();
        $stats['complete'] = Project::where('status', 'Complete')->count();

        return $stats;

    }

    public function trainingStats()
    {
        $stats = ['active' => 0, 'pending' => 0, 'expired' => 0];

        $stats['active'] = Training::where('status', 'Active')->count();
        $stats['pending'] = Training::where('status', 'Pending')->count();
        $stats['expired'] = Document::
                join('trainings', 'trainings.doc_id', '=', 'documents.id')
                ->where('documents.status', 'Expired')->count();


        return $stats;

    }

    public function peopleStats()
    {
        $stats = ['total' => 0, 'active' => 0, 'inactive' => 0];

        $stats['total'] = People::whereNotIn('status', ['Banned', 'Deactivated'])->count();
        $today = date('Y-m-d');
        $projectAssignments = ProjectAssignment::where('start_date', '<=', $today)->where('end_date', '>=', $today)->get();
        $activePeopleCount = [];
        foreach ($projectAssignments as $key => $projectAssignment) 
        {
            if(!isset($activePeopleCount[$projectAssignment->people_id]))
            {
                $activePeopleCount[$projectAssignment->people_id] = 1;
            }
        }


        $stats['active'] = count($activePeopleCount);
        $stats['inactive'] = $stats['total'] - $stats['active'];

        return $stats;

    }

    public function subcontractorStats()
    {
        $stats = ['active' => 0, 'inactive' => 0];

        $subcontractors = Subcontractor::get();
        foreach ($subcontractors as $key => $subcontractor) 
        {
            $subopsIds = Suboperative::where('subcontractor_id', $subcontractor->id)->pluck('id');
            $taskExists = TaskSuboperative::whereIn('suboperative_id', $subopsIds)->count();
            if(!empty($taskExists))
            {
                $stats['active'] += 1;
            }
            else
            {
                $stats['inactive'] += 1;
            }

        }

        return $stats;

    }




    public function suboperativeStats()
    {
        $stats = ['total' => 0, 'active' => 0, 'inactive' => 0];

        $stats['total'] = Suboperative::count();
        $today = date('Y-m-d');
        $projects = Project::where('start_date', '<=', $today)->where('due_date', '>=', $today)->get();
        $activePeopleCount = [];
        foreach ($projects as $key => $project) 
        {
            $projectAssignments = ProjectAssignment::where('project_id', $project->id)->get('people_id');
            foreach ($projectAssignments as $key => $projectAssignment) 
            {
                if(!isset($activePeopleCount[$projectAssignment->people_id]))
                {
                    $activePeopleCount[$projectAssignment->people_id] = 1;
                }
            }
        }

 
        $stats['active'] = count($activePeopleCount);
        $stats['inactive'] = $stats['total'] - $stats['active'];

        return $stats;

    }
    public function skillStats()
    {
        $stats = [];
        $stats['active'] = Document::where('status', 'Active')->count();
        $stats['expiring'] = Document::where('status', 'Expiring')->count();
        $stats['critical'] = Document::where('status', 'Critical')->count();
        $stats['expired'] = Document::where('status', 'Expired')->count();

        return $stats;
    }

    public function companyStatusCount()
    {
        $counts = [];
        $counts['active'] = ['count' => Tenant::where('status', 'Active')->count(), 'class' => 'success'];
        $counts['suspended'] = ['count' => Tenant::where('status', 'Suspended')->count(), 'class' => 'warning'];
        $counts['deleted'] = ['count' => Tenant::where('status', 'Deleted')->count(), 'class' => 'danger'];
        $counts['total'] = ['count' => Tenant::count(), 'class' => 'info'];

        return $counts;
    }


}
