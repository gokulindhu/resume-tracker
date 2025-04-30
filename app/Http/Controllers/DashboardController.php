<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ResumeTracker;
use Illuminate\Http\Request;
use App\Exports\ResumeTrackerExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Validator;

class DashboardController extends Controller
{
    //
    public function dashboard(Request $request)
    {
        $query = ResumeTracker::query();

        if ($request->has('search')) {
            $search = $request->input('search');
            $statusMap = [
                'in progress' => 1,
                'placed'      => 2,
                'bench'       => 3,
                'pending'     => 4,
            ];
            $workingModelMap = [
                'remote' => 1,
                'hybrid' => 2,
                'in-office' => 3,
                
            ];
            $normalizedSearch = strtolower(trim($search));
            $statusId = $statusMap[$normalizedSearch] ?? null;
            $workingModelMapId = $workingModelMap[$normalizedSearch] ?? null;
            $normalizedSearch = str_replace(' ', '%', strtolower($search));
            $query->where(function ($query) use ($statusId, $normalizedSearch, $workingModelMapId) {
                $query->orWhereRaw("REPLACE(LOWER(source), '-', ' ') LIKE ?", ["%{$normalizedSearch}%"])
                    ->orWhereRaw("REPLACE(LOWER(skills), '-', ' ') LIKE ?", ["%{$normalizedSearch}%"])
                    ->orWhereRaw("LOWER(candidate_name) LIKE ?", ["%{$normalizedSearch}%"])
                    ->orWhereRaw("LOWER(candidate_email) LIKE ?", ["%{$normalizedSearch}%"])
                    ->orWhereRaw("LOWER(candidate_phone) LIKE ?", ["%{$normalizedSearch}%"])
                    ->orWhereRaw("LOWER(current_company) LIKE ?", ["%{$normalizedSearch}%"])
                    ->orWhereRaw("LOWER(current_designation) LIKE ?", ["%{$normalizedSearch}%"])
                    ->orWhereRaw("LOWER(total_experience) LIKE ?", ["%{$normalizedSearch}%"])
                    ->orWhereRaw("LOWER(client_name) LIKE ?", ["%{$normalizedSearch}%"])
                    ->orWhereRaw("LOWER(resume_link) LIKE ?", ["%{$normalizedSearch}%"])
                    ->orWhereRaw("LOWER(education) LIKE ?", ["%{$normalizedSearch}%"])
                    ->orWhereRaw("LOWER(comment) LIKE ?", ["%{$normalizedSearch}%"])
                    ->orWhereRaw("LOWER(location) LIKE ?", ["%{$normalizedSearch}%"])
                    ->orWhereRaw("LOWER(current_ctc) LIKE ?", ["%{$normalizedSearch}%"])
                    ->orWhereRaw("LOWER(expected_ctc) LIKE ?", ["%{$normalizedSearch}%"])
                    ->orWhereRaw("LOWER(notice_period) LIKE ?", ["%{$normalizedSearch}%"]);

                // Only add status filter if matched
                if (!is_null($statusId)) {
                    $query->orWhere('status', $statusId);
                }
                if (!is_null($workingModelMapId)) {
                    $query->orWhere('working_model', $workingModelMapId);
                }
            });
        }

        $resume_details = $query->get();

        return view('dashboard', compact('resume_details'));
    }

    public function addresume()
    {

        return view('addresume');
    }
    function viewresume($id)
    {
        if ($id != null) {
            $resume_details = ResumeTracker::find($id);
            if (!isset($resume_details)) {
                return back()->withInput()->withErrors('Resume details was not found');
            }
        }
        return view('viewresume', compact('resume_details'));
    }
    public function deleteresume($id)
    {
        try {

            if ($id != null) {
                $entry = ResumeTracker::find($id);
                if (!isset($entry)) {
                    return back()->withInput()->withErrors('Resume details was not found');
                }
            }
            $entry->delete();
            return redirect('/account/dashboard')->withErrors('Resume details Deleted successfully!');
        } catch (\Exception $e) {
            return redirect('/account/dashboard')->withErrors($e->getMessage());
        }
    }
    function editresume(Request $request, $id)
    {
        return $this->processaddresume($request, $id);
    }

    public function processaddresume(Request $request, $id = null)
    {
        if ($id != null) {
            $entry = ResumeTracker::find($id);
            if (!isset($entry)) {
                return back()->withInput()->withErrors('Resume details was not found');
            }
        }
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'phone' => ['required', 'string', 'max:10'],
            'name' => ['required', 'string'],
            'skills' => ['required', 'string'],
            'resume_link' => ['nullable', 'mimes:pdf,docx', 'max:2048899'],
            'source' => ['required', 'string'],
            'company' => ['required', 'string'],
            'designation' => ['required', 'string'],
            'experience' => ['required', 'string'],
            'client_name' => ['required', 'string'],
            'education'  => ['required', 'string'],
            'status'  => ['required', 'numeric',"in:1,2,3,4"],
            'working_model'  => ['required', 'numeric',"in:1,2,3"],
            'location'  => ['required', "string"],
            'notice_period'  => ['required', "string"],
            'comment'  => ['nullable', 'string'],
            'current_ctc'  => ['required', "string"],
            'expected_ctc'  => ['nullable', 'string'],
        ]);
        $input = $request->all();
        if ($request->hasFile('resume_link')) {
            $imagePath = $request->file('resume_link')->store('resume_link', 'public');
        } else {
            $imagePath = null;
        }

        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator->messages());
        }
        if ($validator->passes()) {
            if ($id != null) {
                $entry->update(
                    [
                        'source' => $input['source'],
                        'skills' => $input['skills'],
                        'candidate_name' => $input['name'],
                        'candidate_email' => $input['email'],
                        'candidate_phone' => $input['phone'],
                        'current_company' => $input['company'],
                        'current_designation' => $input['designation'],
                        'total_experience' => $input['experience'],
                        'client_name' => $input['client_name'],
                        'status' => $input['status'],
                        'resume_link' => $imagePath ?? $entry->resume_link,
                        'education' => $input['education'],
                        'working_model' => $input['working_model'],
                        'notice_period' => $input['notice_period'],
                        'location' => $input['location'],
                        'comment' => $input['comment'] ?? null,
                        'current_ctc' => $input['current_ctc'] ?? null,
                        'expected_ctc' => $input['expected_ctc'] ?? null,
                    ]
                );
                $msg = 'Resume details added successfully';
            } else {
                ResumeTracker::create(
                    [
                        'source' => $input['source'],
                        'skills' => $input['skills'],
                        'candidate_name' => $input['name'],
                        'candidate_email' => $input['email'],
                        'candidate_phone' => $input['phone'],
                        'current_company' => $input['company'],
                        'current_designation' => $input['designation'],
                        'total_experience' => $input['experience'],
                        'client_name' => $input['client_name'],
                        'status' => $input['status'],
                        'resume_link' => $imagePath,
                        'working_model' => $input['working_model'],
                        'notice_period' => $input['notice_period'],
                        'location' => $input['location'],
                        'education' => $input['education'],
                        'comment' => $input['comment'] ?? null,
                        'current_ctc' => $input['current_ctc'] ?? null,
                        'expected_ctc' => $input['expected_ctc'] ?? null,
                    ]
                );

                $msg = 'Resume details updated successfully';
            }


            return redirect()->route('account.dashboard')->with('success', $msg);
        }
    }

    public function loadEditForm($id)
    {
        if ($id != null) {
            $entry = ResumeTracker::find($id);
            if (!isset($entry)) {
                return  redirect()->route('account.dashboard')->withErrors('Resume details was not found');
            }
        }
        $resume_details = ResumeTracker::find($id);
        return view('addresume', compact('resume_details'));
    }

    public function exportResumeTracker(Request $request)
    {
        $search = $request->input('search');
        $filename = 'resume_tracker_'.date('d_m_y_h_i_s').'.xlsx';
        return Excel::download(new ResumeTrackerExport($search), $filename);
    }
}
