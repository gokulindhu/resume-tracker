@extends('Layouts.masterlayout')
@section('main-content')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<div class="page-wrapper">
  <!-- ============================================================== -->
  <!-- Bread crumb and right sidebar toggle -->
  <!-- ============================================================== -->

  <!-- ============================================================== -->
  <!-- End Bread crumb and right sidebar toggle -->
  <!-- ============================================================== -->
  <!-- -------------------------------------------------------------- -->
  <!-- Container fluid  -->
  <!-- -------------------------------------------------------------- -->
  <div class="container-fluid">
    <!-- -------------------------------------------------------------- -->
    <!-- Start Page Content -->
    <!-- -------------------------------------------------------------- -->
    <div class="widget-content searchable-container list">
      <div class="card card-body">
        <div class="row">
          <div class="col-12">
            @include('errors')
          </div>
          <div class="row">
            <div class="col-md-6 col-xl-2">
              <form action="/account/dashboard" method="GET">

                <div class="d-flex justify-content-center">
                  <input
                    type="text"
                    class="form-control product-search "
                    id="input-search"
                    name="search"
                    required
                    value="{{ request('search') }}" 
                    placeholder="Search details..." />

                  <button type="submit" class="btn btn-info ms-2 d-block">
                    Search
                  </button>
                  <a href="/account/dashboard" class="btn btn-danger ms-2 d-block">
                    Reset
                  </a>
                </div>
              </form>

            </div>
            <div
              class="
                    col-md-6 col-xl-10
                    text-end
                    d-flex
                   
                    justify-content-md-end justify-content-center
                    mt-3 mt-md-0
                  ">
                  <a href="{{ route('resume.export', ['search' => request('search')]) }}" class="btn btn-success  me-2">
                  Export
                </a>
              <a
                href="/addresume"
                id="btn-add-contact"
                class="btn btn-info">
                <i data-feather="file" class="feather-sm fill-white ">
                </i>
                Add Resume</a>
            </div>
          </div>
        </div>

        <div class="card card-body">
          <div class="table-responsive" style="overflow-x: auto;">
          <table class="table table-bordered table-hover search-table v-middle" style="min-width: 1024px;">
          <thead class="header-item">
                <th>Id</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone no</th>
                <th>Source</th>
                <th>Skills</th>
                <th>Designation</th>
                <th>Working Model</th>
                <th>Preferred Location</th>
                <th>Notice Period</th>
                <th>Status</th>
                <th>Current CTC</th>
                <th>Expected CTC</th>
                <th>Created Date</th>
                <th>Updated Date</th>
                <th>Action</th>
              </thead>
              <tbody>
                <!-- row -->
                @foreach($resume_details as $resume_detail)
                <tr>

                  <td>{{$resume_detail->id}}</td>
                  <td>{{$resume_detail->candidate_name}}</td>
                  <td>{{$resume_detail->candidate_email}}</td>
                  <td>{{$resume_detail->candidate_phone}}</td>
                  <td>{{$resume_detail->source}}</td>
                  <td class="w-100">
                    @foreach(explode(',', $resume_detail->skills) as $skill)
                    <span class="badge bg-secondary me-1">{{ trim($skill) }}</span>
                    @endforeach
                  </td>
                  <td>{{$resume_detail->current_designation}}</td>
                  <td>
                    @php
                    $working_model = [
                    1 => ['label' => 'Remote', 'class' => 'warning'],
                    2 => ['label' => 'Hybrid', 'class' => 'warning'],
                    3 => ['label' => 'In-Office', 'class' => 'warning'],
                    ];
                    $model = $working_model[$resume_detail->working_model] ?? ['label' => 'Unknown', 'class' => 'dark'];
                    @endphp
                    <span class="badge bg-{{ $model['class'] }}">
                      {{ $model['label'] }}
                    </span>
                  </td>
                  <td>{{$resume_detail->location}}</td>
                  <td>{{$resume_detail->notice_period}}</td>
                  <td>
                    @php
                    $statuses = [
                    1 => ['label' => 'In Progress', 'class' => 'warning'],
                    2 => ['label' => 'Placed', 'class' => 'success'],
                    3 => ['label' => 'Bench', 'class' => 'secondary'],
                    4 => ['label' => 'Pending', 'class' => 'danger'],
                    ];

                    $status = $statuses[$resume_detail->status] ?? ['label' => 'Unknown', 'class' => 'dark'];
                    @endphp

                    <span class="badge bg-{{ $status['class'] }}">
                      {{ $status['label'] }}
                    </span>
                  </td>
                  <td>{{$resume_detail->current_ctc}}</td>
                  <td>{{$resume_detail->expected_ctc}}</td>
                  <td>{{$resume_detail->created_at}}</td>
                  <td>{{$resume_detail->updated_at}}</td>
                  <td>
                    <div class="d-flex">


                      <a href="/deleteresume/{{$resume_detail->id}}" class="btn btn-danger"
                        style="  border-radius: .3rem; padding: .13rem .6rem; margin-right: .4rem;">
                        <i
                          data-feather="trash-2"
                          class="feather-sm fill-white"></i></a>
                      <a href="/updateresume/{{$resume_detail->id}}"
                        style=" background-color:#6610f2; border-radius: .3rem; padding: .13rem .6rem; margin-right: .4rem;">
                        <i class="fa-regular fa-pen-to-square" style="color: white;"></i></a>
                      <a href="/viewresume/{{$resume_detail->id}}"
                        style=" background-color: #6f42c1; border-radius: .3rem; padding: .13rem .6rem; margin-right: .4rem;">
                        <i class="fa-regular fa-eye" style="color: white;"></i></a>
                    </div>
                  </td>
                </tr>
                @endforeach

                <!-- /.row -->
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <!-- -------------------------------------------------------------- -->
      <!-- End PAge Content -->
      <!-- -------------------------------------------------------------- -->
    </div>
    <!-- Share Modal -->
  </div>
</div>
    <script>
      function showResults() {
        document.getElementById('results').style.display = 'block';
      }
    </script>

    @endsection