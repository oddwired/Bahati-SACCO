@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-2 col-md-2 col-lg-1 col-xl-1">
                <nav class="nav navbar-light navbar-toggleable-sm">
                    <div class="flex-column mt-md-0 mt-4 pt-md-0 pt-4" id="navbarWEX">
                        <a class="nav-link" href="{{url('admin')}}"><span class="fa fa-home"></span>Dashboard</a>
                        <a href="{{url('admin/members')}}" class="nav-link">Members</a>
                        <a href="{{url('admin/conductors')}}" class="nav-link">Conductors</a>
                        <a href="{{url('admin/conductor-reports')}}" class="nav-link">Conductor reports</a>
                        <a href="{{url('admin/loans')}}" class="nav-link navbar-brand active">Loans</a>
                    </div>
                </nav>
            </div>
            <div class="col-sm-10 col-md-10 col-lg-11 col-xl-11">
                @if(session('info'))
                    <div class="row justify-content-center">
                        <div class="alert alert-success">
                            {{session('info')}}
                        </div>
                    </div>
                @endif
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header">Loan applications</div>
                            <div class="card-body">

                                <table class="table" id="membersTable">
                                    <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Name</th>
                                        <th>Amount(KSH)</th>
                                        <th>Status</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($loans as $loan)
                                        <tr>
                                            <td>{{(new DateTime($loan->created_at))->format('d/m/Y')}}</td>
                                            <td>
                                                <a href="#"
                                                onclick="updateModal('{{$loan->member->first_name}} {{$loan->member->middle_name}} {{$loan->member->last_name}}',
                                                        '{{$loan->member->national_id}}',
                                                        '{{$loan->member->phone}}',
                                                        '{{$loan->member->email}}',
                                                        '{{$loan->member->postal_address}}',
                                                        '{{$loan->member->postal_code}}',
                                                        '{{$loan->member->postal_town}}',
                                                        '{{$loan->bank_name}}',
                                                        '{{$loan->bank_branch}}',
                                                        '{{$loan->bank_account_name}}',
                                                        '{{$loan->bank_account_number}}'
                                                        )"
                                                >{{$loan->member->first_name}} {{$loan->member->middle_name}} {{$loan->member->last_name}}</a>
                                            </td>
                                            <td>{{$loan->amount}}</td>
                                            <td>
                                                <form action="{{url('admin/update-loan-status/'.$loan->serial_number)}}" id="statusForm">
                                                    @csrf
                                                    <select name="status" id="" class="form-control" onchange="$('#statusForm').submit()">
                                                        <option value="1" {{$loan->status == 1 ? "selected": ""}}>Pending</option>
                                                        <option value="2" {{$loan->status == 2 ? "selected": ""}}>Received</option>
                                                        <option value="3" {{$loan->status == 3 ? "selected": ""}}>Approved</option>
                                                        <option value="4" {{$loan->status == 4 ? "selected": ""}}>Rejected</option>
                                                        <option value="5" {{$loan->status == 5 ? "selected": ""}}>Disbursed</option>
                                                    </select>
                                                </form>

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
        </div>
    </div>

    <div class="modal fade" id="loanInfoModal" tabindex="-1" role="dialog" aria-labelledby="itemModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Applicant Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="btnclose">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm">
                            <b>Full Name:</b> <div id="memberName"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm">
                            <b>National ID: </b> <div id="nationalID"></div>
                        </div>
                        <div class="col-sm">
                            <b>Mobile Number: </b> <div id="phone"></div>
                        </div>
                        <div class="col-sm">
                            <b>Email: </b> <div id="email"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm">
                            <b>Postal Address: </b> <div id="postalAddress"></div>
                        </div>
                        <div class="col-sm">
                            <b>Postal Code: </b> <div id="postalCode"></div>
                        </div>
                        <div class="col-sm">
                            <b>Town: </b> <div id="postalTown"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm">
                            <b>Bank: </b> <div id="bankName"></div>
                        </div>
                        <div class="col-sm">
                            <b>Branch:</b> <div id="bankBranch"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm">
                            <b>Account Name: </b> <div id="bankAccountName"></div>
                        </div>
                        <div class="col-sm">
                            <b>Account Number:</b> <div id="bankAccountNumber"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('jscontent')
    <script>
        function updateModal(name, national_id, phone, email, postalAddress, code, town,
                    bankName, branch, accountName, accountNumber){
            $('#memberName').html(name);
            $('#nationalID').html(national_id);
            $('#phone').html(phone);
            $('#email').html(email);
            $('#postalAddress').html(postalAddress);
            $('#postalCode').html(code);
            $('#postalTown').html(town);
            $('#bankName').html(bankName);
            $('#bankBranch').html(branch);
            $('#bankAccountName').html(accountName);
            $('#bankAccountNumber').html(accountNumber);

            $('#loanInfoModal').modal('show');
        }

        $(document).ready(function(){
            @if(count($errors) > 0)
            $('#newConductorModal').modal('show');
            @endif
        });
    </script>
@endsection