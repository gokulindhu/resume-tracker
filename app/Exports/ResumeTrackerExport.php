<?php

namespace App\Exports;

use App\Models\ResumeTracker;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ResumeTrackerExport implements FromCollection, WithHeadings, WithMapping
{
    protected $search;

    public function __construct($search = null)
    {
        $this->search = $search;
    }

    public function collection()
    {
        $query = ResumeTracker::query();

        if ($this->search) {
            $statusMap = [
                'in progress' => 1,
                'placed' => 2,
                'bench' => 3,
                'pending' => 4,
            ];
            $workingModelMap = [
                'remote' => 1,
                'hybrid' => 2,
                'in-office' => 3,
            ];
            $normalizedSearch = strtolower(trim($this->search));
            $statusId = $statusMap[$normalizedSearch] ?? null;
            $workingModelMapId = $workingModelMap[$normalizedSearch] ?? null;
            $normalizedSearch = str_replace(' ', '%', $normalizedSearch);

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

                if (!is_null($statusId)) {
                    $query->orWhere('status', $statusId);
                }
                if (!is_null($workingModelMapId)) {
                    $query->orWhere('working_model', $workingModelMapId);
                }
            });
        }

        return $query->get();
    }

    public function headings(): array
    {
        return [
            'Id',
            'Source',
            'Skills',
            'Candidate Name',
            'Candidate Email',
            'Candidate Phone',
            'Current Company',
            'Current Designation',
            'Total Experience',
            'Client Name',
            'Status',
            'Resume Link',
            'Education',
            'Comment',
            'Working Model',
            'Preferred Location',
            'Notice Period',
            'Current CTC',
            'Expected CTC',
            'Created At',
            'Updated At'
        ];
    }

    public function map($row): array
    {
        $statusLabels = [
            1 => 'In Progress',
            2 => 'Placed',
            3 => 'Bench',
            4 => 'Pending',
        ];

        $workModelLabels = [
            1 => 'Remote',
            2 => 'Hybrid',
            3 => 'In-office',
        ];

        return [
            $row->id,
            $row->source,
            $row->skills,
            $row->candidate_name,
            $row->candidate_email,
            $row->candidate_phone,
            $row->current_company,
            $row->current_designation,
            $row->total_experience,
            $row->client_name,
            $statusLabels[$row->status] ?? 'Unknown',
            $row->resume_link,
            $row->education,
            $row->comment,
            $workModelLabels[$row->working_model] ?? 'Unknown',
            $row->location,
            $row->notice_period,
            $row->current_ctc,
            $row->expected_ctc,
            $row->created_at,
            $row->updated_at,
        ];
    }
}
