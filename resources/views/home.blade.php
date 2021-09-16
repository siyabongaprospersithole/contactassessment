@extends('layouts.app')

@section('content')
<!-- displaying contacts -->
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Contacts') }}</div>

                <div class="card-body">              
                  <table class="table table-striped">
                  <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Gender</th>
                        <th>Content</th>
                        <th>Date Created</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($contacts as $contact)
                    <tr>
                        <td>{{$contact->rownum}}</td>
                        <td>{{$contact->name}}</td>
                        <td>{{$contact->email}}</td>
                        <td>{{$contact->gender_name}}</td>
                        <td>{{$contact->content}}</td>
                        <td>{{$contact->created_at}}</td>
                    </tr>
                @endforeach
                </tbody>
                  </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- end displaying contacts -->
@endsection

<!-- include link to init datatable, so it's only called on this page -->
@section('scripts')  
<script type="text/javascript">
     $(document).ready(function() {
        $.noConflict();
    $('.table').DataTable();
    });
    </script>
@endsection