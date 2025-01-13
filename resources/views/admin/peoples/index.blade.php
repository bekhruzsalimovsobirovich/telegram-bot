@extends('layouts.master')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Foydalanuvchilar ro'yxati</h5>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>FIO</th>
                            <th>Username</th>
                            <th>Telefon raqam</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($peoples as $people)
                            <tr>
                                <td>{{ $loop->index + 1 }}</td>
                                <td>{{ $people->name }}</td>
                                <td>
                                    <a target="_blank" href="https://t.me/{{$people->username}}"><i class="ph-telegram-logo"></i> {{ $people->username }}</a>
                                </td>
                                <td>{{ $people->phone }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-center">
                    {{$peoples->links()}}
                </div>
            </div>
        </div>
    </div>
@endsection
