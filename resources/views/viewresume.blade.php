@extends('Layouts.masterlayout')

@section('content')
<div class="page-wrapper">
  <!-- ============================================================== -->
  <!-- Bread crumb and right sidebar toggle -->
  <!-- ============================================================== -->
  <div class="row page-titles">


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
      <!-- Row -->
      <div class="row">
          <div class="col-12">
            @include('errors')
          </div>
      <div class="row">

        <!-- Column -->
        <div class="col-lg-12 col-xlg-9 col-md-7">
          <div class="card">
            <!-- Tabs -->
            <ul
              class="nav nav-pills custom-pills"
              id="pills-tab"
              role="tablist">


              <li class="nav-item">
                <a
                  class="nav-link"
                  id="pills-profile-tab"
                  data-bs-toggle="pill"
                  href="#last-month"
                  role="tab"
                  aria-controls="pills-profile"
                  aria-selected="false">Candidate Details</a>
              </li>

            </ul>
            <!-- Tabs -->
            <div
              class="tab-content"
              id="last-month"
              role="tabpanel"
              aria-labelledby="pills-profile-tab">
              <div class="card-body">
                <div class="row">
                  <div class="col-12">
                    @if(isset($resume_details))
                    <form class="form-horizontal" action="/updateresume/{{$resume_details->id}}" method="post" enctype="multipart/form-data">
                      <input readonly type="hidden" name="_method" value="PUT">
                      @else
                      <form class="form-horizontal" action="{{ route('process-addresume') }}" method="post" enctype="multipart/form-data">
                        @endif
                        @csrf
                        

                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-floating mb-3">
                              <input readonly type="text" value="{{ old('source', isset($resume_details->source) ? $resume_details->source : null) }}" class="form-control form-input-bg @error('source') is-invalid @enderror" name="source" id="source" placeholder="Source" />
                              <label for="source">Source</label>
                              @error('source')
                              <p class="invalid-feedback">{{ $message }}</p>
                              @enderror
                            </div>
                          </div>

                          <div class="col-md-6">
                            <div class="form-floating mb-3">
                              <input readonly type="name" value="{{ old('name', isset($resume_details->candidate_name) ? $resume_details->candidate_name : null) }}" class="form-control form-input-bg @error('name') is-invalid @enderror" name="name" id="name" placeholder="name" />
                              <label for="name">Name</label>
                              @error('name')
                              <p class="invalid-feedback">{{ $message }}</p>
                              @enderror
                            </div>
                          </div>

                        </div>
                        <div class="row">
                         
                          <div class="col-md-6">
                            <div class="form-floating mb-3">
                              <input readonly type="email" value="{{ old('email', isset($resume_details->candidate_email) ? $resume_details->candidate_email : null) }}" class="form-control form-input-bg @error('email') is-invalid @enderror" name="email" id="email" placeholder="name@example.com" />
                              <label for="email">Email</label>
                              @error('email')
                              <p class="invalid-feedback">{{ $message }}</p>
                              @enderror
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-floating mb-3">
                              <input readonly type="text" value="{{ old('phone', isset($resume_details->candidate_phone) ? $resume_details->candidate_phone : null) }}" class="form-control form-input-bg @error('phone') is-invalid @enderror" name="phone" id="phone" placeholder="123456" />
                              <label for="phone">Contact Number</label>
                              @error('phone')
                              <p class="invalid-feedback">{{ $message }}</p>
                              @enderror
                            </div>
                          </div>
                        </div>
                       

                        <div class="row">
                          <div class="col-md-4">
                            <div class="form-floating mb-3">
                              <input readonly type="text" value="{{ old('company' , isset($resume_details->current_company) ? $resume_details->current_company : null) }}" class="form-control form-input-bg @error('company') is-invalid @enderror" name="company" id="company" placeholder="ABC solutions" />
                              <label for="company">Current Company</label>
                              @error('company')
                              <p class="invalid-feedback">{{ $message }}</p>
                              @enderror
                            </div>
                          </div>
                          <div class="col-md-4">
                            <div class="form-floating mb-3">
                              <input readonly type="text" value="{{ old('designation' , isset($resume_details->current_designation) ? $resume_details->current_designation : null) }}" class="form-control form-input-bg @error('designation') is-invalid @enderror" name="designation" id="designation" placeholder="Developer" />
                              <label for="designation">Designation</label>
                              @error('designation')
                              <p class="invalid-feedback">{{ $message }}</p>
                              @enderror
                            </div>
                          </div>
                          <div class="col-md-4">
                            <div class="form-floating mb-3">
                              <input readonly type="number" value="{{ old('experience' , isset($resume_details->total_experience) ? $resume_details->total_experience : null) }}" class="form-control form-input-bg @error('experience') is-invalid @enderror" name="experience" id="experience" placeholder="2" />
                              <label for="experience">Experience</label>
                              @error('experience')
                              <p class="invalid-feedback">{{ $message }}</p>
                              @enderror
                            </div>
                          </div>
                        </div>

                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-floating mb-3">
                              <input readonly type="text" value="{{ old('client_name' , isset($resume_details->client_name) ? $resume_details->client_name : null) }}" class="form-control form-input-bg @error('client_name') is-invalid @enderror" name="client_name" id="client_name" placeholder="client_name" />
                              <label for="client_name">Client Name</label>
                              @error('client_name')
                              <p class="invalid-feedback">{{ $message }}</p>
                              @enderror
                            </div>
                          </div>

                          <div class="col-md-6">
                            <div class="form-floating mb-3">
                              <input readonly type="textarea" value="{{ old('education' , isset($resume_details->education) ? $resume_details->education : null) }}" class="form-control form-input-bg @error('education') is-invalid @enderror" name="education" id="education" placeholder="education" />
                              <label for="education">Education</label>
                              @error('education')
                              <p class="invalid-feedback">{{ $message }}</p>
                              @enderror
                            </div>
                          </div>
                        </div>

                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-floating mb-3">
                              <select readonly disabled
                                class="disabled form-select form-input-bg @error('status') is-invalid @enderror"
                                name="status"
                                id="status">
                                <option disabled selected value="">Select Status</option>
                                <option value="1" {{ old('status', isset($resume_details->status) ? $resume_details->status : null) == '1' ? 'selected' : '' }}>In Progress</option>
                                <option value="2" {{ old('status',  isset($resume_details->status) ? $resume_details->status : null) == '2' ? 'selected' : '' }}>Placed</option>
                                <option value="3" {{ old('status',  isset($resume_details->status) ? $resume_details->status : null) == '3' ? 'selected' : '' }}>Bench</option>
                                <option value="4" {{ old('status',  isset($resume_details->status) ? $resume_details->status : null) == '4' ? 'selected' : '' }}>Pending</option>
                              </select>
                              <label for="status">Status</label>
                              @error('status')
                              <p class="invalid-feedback">{{ $message }}</p>
                              @enderror
                            </div>
                          </div>

                          <div class="col-md-6">
                            <div class="form-floating mb-3">
                              <input readonly type="text" value="{{ old('comment' , isset($resume_details->comment) ? $resume_details->comment : null) }}" class="form-control form-input-bg @error('comment') is-invalid @enderror" name="comment" id="comment" placeholder="write comment here..." />
                              <label for="comment">Write comments here...</label>
                            </div>
                          </div>
                        </div>

                        <div class="row">
                          <div class="col-md-4">
                            <div class="form-floating mb-3">
                              <select readonly disabled
                                class="disabled form-select form-input-bg @error('working_model') is-invalid @enderror"
                                name="working_model"
                                id="working_model">
                                <option disabled selected value="">Select Working Model</option>
                                <option value="1" {{ old('working_model', isset($resume_details->working_model) ? $resume_details->working_model : null) == '1' ? 'selected' : '' }}>Remote</option>
                                <option value="2" {{ old('working_model',  isset($resume_details->working_model) ? $resume_details->working_model : null) == '2' ? 'selected' : '' }}>Hybrid</option>
                                <option value="3" {{ old('working_model',  isset($resume_details->working_model) ? $resume_details->working_model : null) == '3' ? 'selected' : '' }}>In-Office</option>
                              </select>
                              <label for="working_model">Working Model</label>
                              @error('working_model')
                              <p class="invalid-feedback">{{ $message }}</p>
                              @enderror
                            </div>
                          </div>

                          <div class="col-md-4">
                            <div class="form-floating mb-3">
                              <input readonly type="text" value="{{ old('location' , isset($resume_details->location) ? $resume_details->location : null) }}" class="form-control form-input-bg @error('location') is-invalid @enderror" name="location" id="location" placeholder="write location here..." />
                              <label for="location">Preferred Location</label>
                            </div>
                          </div>
                          <div class="col-md-4">
                            <div class="form-floating mb-3">
                              <input readonly type="text" value="{{ old('notice_period' , isset($resume_details->notice_period) ? $resume_details->notice_period : null) }}" class="form-control form-input-bg @error('notice_period') is-invalid @enderror" name="notice_period" id="notice_period" placeholder="write notice_period here..." />
                              <label for="notice_period">Notice Period</label>
                            </div>
                          </div>
                        </div>

                        <div class="row">
                  <div class="col-md-6">
                    <div class="form-floating mb-3">
                      <input readonly type="text" value="{{ old('current_ctc' , isset($resume_details->current_ctc) ? $resume_details->current_ctc : null) }}" class="form-control form-input-bg @error('current_ctc') is-invalid @enderror" name="current_ctc" id="current_ctc" placeholder="current_ctc" />
                      <label for="current_ctc">Current CTC</label>
                      @error('current_ctc')
                      <p class="invalid-feedback">{{ $message }}</p>
                      @enderror
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-floating mb-3">
                      <input type="textarea"  readonly  value="{{ old('expected_ctc' , isset($resume_details->expected_ctc) ? $resume_details->expected_ctc : null) }}" class="form-control form-input-bg @error('expected_ctc') is-invalid @enderror" name="expected_ctc" id="expected_ctc" placeholder="expected_ctc" />
                      <label for="expected_ctc">Expected ctc</label>
                      @error('expected_ctc')
                      <p class="invalid-feedback">{{ $message }}</p>
                      @enderror
                    </div>
                  </div>
                </div>
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-floating mb-3">
                              <input readonly type="text" value="{{ old('created_at' , isset($resume_details->created_at) ? $resume_details->created_at : null) }}" class="form-control form-input-bg @error('created_at') is-invalid @enderror" name="created_at" id="created_at" placeholder="created_at" />
                              <label for="created_at">Created Date </label>
                              @error('created_at')
                              <p class="invalid-feedback">{{ $message }}</p>
                              @enderror
                            </div>
                          </div>

                          <div class="col-md-6">
                            <div class="form-floating mb-3">
                              <input readonly type="textarea" value="{{ old('updated_at' , isset($resume_details->updated_at) ? $resume_details->updated_at : null) }}" class="form-control form-input-bg @error('updated_at') is-invalid @enderror" name="updated_at" id="updated_at" placeholder="updated_at" />
                              <label for="updated_at">Updated Date</label>
                              @error('updated_at')
                              <p class="invalid-feedback">{{ $message }}</p>
                              @enderror
                            </div>
                          </div>
                        </div>
                       
                      </form>
                      <!-- -------------------------------------------------------------- -->
                      <!-- Login box.scss -->
                      <!-- -------------------------------------------------------------- -->
                  </div>
                </div>
                <hr>

                <h4 class="font-weight-medium mt-4">Skill Set</h4>
                <hr>
                <div class="row">
                  <div class="col-md-12">
                    <div class="d-flex flex-wrap">
                      @foreach(explode(',', $resume_details->skills) as $skill)
                      <span class="badge bg-secondary me-1">{{ trim($skill) }}</span>
                      @endforeach
                    </div>
                  </div>
                </div>
                <hr>

                <h4 class="font-weight-medium mt-4">Resume</h4>
                <hr>
                <div class="row">
                  <div class="col-md-12">
                    <div class="d-flex flex-wrap">
                      <a href="{{ $resume_details->resume_link }}" target="_blank">View Resume<i class="fas fa-download ms-2"></i></a>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Column -->
            </div>
            <!-- Row -->
            <!-- -------------------------------------------------------------- -->
            <!-- End PAge Content -->
            <!-- -------------------------------------------------------------- -->
          </div>
          
          @endsection