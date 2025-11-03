@extends('layouts.newsingle')

@section('newcontent')
    <div class=" container">
        <div class=" row d-flex justify-content-center">
            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif



            <div class="col-4 card m-2 p-4">
                <h4 class="text-center mb-4">Xodimlar kirish</h4>
                <form method="POST" action="{{ route('loginemployee-to-database') }}">
                    @csrf
                    <!-- Name input -->
                    <div data-mdb-input-init class="form-outline mb-4">
                        <input type="text" id="form5Example1" class="form-control" name="employee_id_number"
                            placeholder="Xodim ID" />
                        <label class="form-label" for="form5Example1">Login</label>
                    </div>

                    <!-- Email input -->
                    <div data-mdb-input-init class="form-outline mb-4">
                        <input type="password" id="form5Example2" class="form-control" name="password"
                            placeholder="Parol" />
                        <label class="form-label" for="form5Example2">Parol</label>
                    </div>


                    <!-- Submit button -->
                    <button type="submit" class="btn btn-primary w-100  mb-4">Tizimga kirish</button>
                    <a href="{{ route('hemis.web.employee') }}" class="btn btn-success d-grid w-100">HEMIS orqali kirish</a>
                </form>
            </div>

            <div class="col-4 card  m-2 p-4">
                <h4 class="text-center mb-4">Talabalar kirish</h4>
                <form method="POST" action="{{ route('loginstudent-to-database') }}">
                    @csrf
                    <!-- Name input -->
                    <div data-mdb-input-init class="form-outline mb-4">
                        <input type="text" id="form5Example1" class="form-control" name="student_id_number"
                            placeholder="Student ID" />
                        <label class="form-label" for="form5Example1">Login</label>
                    </div>

                    <!-- Email input -->
                    <div data-mdb-input-init class="form-outline mb-4">
                        <input type="password" id="form5Example2" class="form-control" name="password"
                            placeholder="Parol" />
                        <label class="form-label" for="form5Example2">Parol</label>
                    </div>


                    <!-- Submit button -->
                    <button type="submit" class="btn btn-primary w-100  mb-4">Tizimga kirish</button>
                    <a href="{{ route('hemis.web.student') }}" class="btn btn-success d-grid w-100">HEMIS orqali kirish</a>
                </form>
            </div>
        </div>
    </div>
@endsection
