@extends('layouts.master')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Murojaatlar ro'yxati</h5>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Kim yuborgan</th>
                            <th>Murojat</th>
                            <th>Yuborilgan sana</th>
                            <th>Tekshirilgan sana</th>
                            <th>Holati</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($appeals as $appeal)
                            <tr>
                                <td>{{ $loop->index + 1 }}</td>
                                <td role="button" data-bs-toggle="modal" data-bs-target="#data_{{$appeal->id}}" class="fw-bold">
                                    {{ $appeal->people->name }}
                                    <div id="data_{{$appeal->id}}" class="modal fade" tabindex="-1" style="display: none;" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Foydalanuvchi ma'lumotlari</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                </div>

                                                <div class="modal-body">
                                                    <p>FIO: {{ $appeal->people->name }}</p>
                                                    <p>Telefon: {{ $appeal->people->phone }}</p>
                                                    <p>Username: <a target="_blank" href="https://t.me/{{$appeal->people->username}}"><i class="ph-telegram-logo"></i> {{ $appeal->people->username }}</a></p>
                                                </div>

                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-link" data-bs-dismiss="modal">Yopish</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td role="button" data-bs-toggle="modal" data-bs-target="#text_{{$appeal->id}}" class="fw-bold">
                                    {{ \Illuminate\Support\Str::limit($appeal->text,100,'...') }}
                                    <div id="text_{{$appeal->id}}" class="modal fade" tabindex="-1" style="display: none;" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Murojat</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                </div>

                                                <div class="modal-body">
                                                    <p>{{ $appeal->text }}</p>
                                                </div>

                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-link" data-bs-dismiss="modal">Yopish</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td>{{ \Carbon\Carbon::parse($appeal->created_at) }}</td>
                                <td>
                                    @if($appeal->status == 'success')
                                        {{ $appeal->updated_at }}
                                    @endif
                                </td>
                                <td>
                                    @if($appeal->status == 'pending')
                                        {{--                                        <span class="badge bg-warning">{{ $appeal->status }}</span>--}}
                                        <form method="post" action="{{ route('admin.check-appeal',$appeal) }}">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-success"><i class="ph-check"></i></button>
                                        </form>
                                    @else
                                        <span class="badge bg-success">Tekshirilgan</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-center">
                    {{$appeals->links()}}
                </div>
            </div>
        </div>
    </div>
@endsection
