<x-app-layout>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Employee Register Form<span class="bg-blue-500 text-white rounded px-1 text-xs py-0.5"></span></h4>
                    {{-- @can('Role create') --}}
                    <div>
                        <a href="{{route('info_employee.list')}}" class="btn btn-sm btn-primary"><i class="fa fa-reply"></i><span class="btn-icon-add"></span>Employee List</a>
                        <button class="btn btn-sm btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg">Fill Up Info</button>
                    </div>
                    {{-- @endcan --}}
                </div>
                <div class="card-body">
                    <form class="row" action="{{ route('employee_register.store') }}" method="POST">
                        @csrf
                        <div class="col-xl-6">
                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label">Employee Name
                                    <span class="text-danger">*</span>
                                </label>
                                <div class="col-lg-7">
                                    <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{old('name')}}" placeholder="">
                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label">Email
                                    <span class="text-danger">*</span>
                                </label>
                                <div class="col-lg-7">
                                    <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{old('email')}}" placeholder="">
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label">Contact Number
                                    <span class="text-danger">*</span>
                                </label>
                                <div class="col-lg-7">
                                    <input type="number" name="contact_number" id="contact_number" class="form-control @error('contact_number') is-invalid @enderror" value="{{old('contact_number')}}" placeholder="">
                                    @error('contact_number')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label">Password
                                    <span class="text-danger">*</span>
                                </label>
                                <div class="col-lg-7">
                                    <input type="text" name="password" id="password" class="form-control @error('password') is-invalid @enderror" value="12345678" placeholder="">
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-8 ml-auto">
                                    <button type="submit" class="btn btn-sm btn-primary">Submit</button>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-12">
                            
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
    @if (count($user) > 0)
    <!-- Modal -->
    <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Fill Up Information</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                    </button>
                </div>
                <div class="modal-body pt-3">
                    <div class="d-flex justify-content-center">
                        <h5 class="text-danger text-center">This Epmployee Information Not Fill Up!</h5>
                    </div>
                    <div class="table-responsive">
                        <table id="example3" class="display">
                            <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Name</th>
                                    <th>Contact</th>
                                    <th class="text-center">Personal</th>
                                    <th class="text-center">Related</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($user as $key=> $row)
                                <tr>
                                    <td>{{++$key}}</td>
                                    <td style="width: 120px">
                                        <div>{{ $row->name}}</div>
                                        <div>{{ $row->employee_code}}</div>
                                    </td>
                                    <td>
                                        <div>{{ $row->email}}</div>
                                        <div>{{ $row->contact_number}}</div>
                                    </td>
                                    <td class="text-center">
                                        @if ($row->status == 0)
                                            <a href="{{ route('info_employee_prsonal.create', $row->id) }}" class="btn btn-success btn-xs">Fill Up</a><br>
                                        @else
                                            <button class="btn btn-success btn-xs" disabled>Done</button><br>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @if ($row->is_admin == 0)
                                            <a href="{{ route('info_employee_related.create', $row->id) }}" class="btn btn-success btn-xs">Fill Up</a>
                                        @else
                                            <button class="btn btn-success btn-xs" disabled>Done</button><br>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @if ($row->status == 0)
                                            <a href="{{route('employee_register.destroy', $row ->id)}}" class="btn btn-danger shadow btn-xs" id="delete"><i class="fa fa-trash"></i></a>
                                        @endif
                                        {{-- @can('User delete')
                                        <form action="{{ route('employee_register.destroy', $row->id) }}" method="POST">
                                            @method('DELETE')
                                            @csrf
                                            <button class="btn btn-danger shadow btn-xs" onclick="return confirm('Are you sure?');" type="submit"><i class="fa fa-trash"></i></button>
                                        </form>
                                        @endcan --}}
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif

    @push('script')
    <script type="text/javascript">
        $(document).ready(function() {
            // Show the Bootstrap modal when the page is loaded
            $('.bd-example-modal-lg').modal('show');
        });
        
        function reloadPageWithAlert() {
            // Show the Bootstrap modal
            $('bd-example-modal-lg').modal('show');

            // Reload the page after a delay (2 seconds in this example)
            setTimeout(function() {
                location.reload();
            }, 2000);
        }
    </script>
    @endpush
</x-app-layout>
