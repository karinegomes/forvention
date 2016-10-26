<table id="companies-table" class="table table-bordered table-striped dt-responsive nowrap hover" cellspacing="0"
       width="100%">
    <thead>
    <tr>
        <th>Title</th>
        <th>File name</th>
        @if(Auth::user()->hasPermission('VIEW_COMPANY'))
            <th>Actions</th>
        @endif
    </tr>
    </thead>
    <tbody>
    @foreach($medias as $media)
        <tr>
            {{--Title--}}
            <td><a href="{{ url('companies/' . $company->id . '/medias/' . $media->id) }}">{{ $media->title }}</a></td>

            {{--File name--}}
            <td>{{ $media->file_name }}</td>

            {{--Actions--}}
            @if(Auth::user()->hasPermission('VIEW_COMPANY'))
                <td>
                    <div class="text-center">
                        {{-- View --}}
                        <a href="{{ $media->absolute_path }}" target="_blank" class="btn btn-primary btn-xs">
                            <i class="fa fa-folder"></i>
                            View</a>

                        {{-- Edit --}}
                        @if(Auth::user()->hasPermission('MANAGE_COMPANY_INFO', null, $company->id))
                            <a href="{{ url('companies/' . $company->id . '/medias/' . $media->id . '/edit') }}"
                               class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> Edit </a>
                        @endif

                        {{-- Delete --}}
                        @if(Auth::user()->hasPermission('MANAGE_COMPANY_INFO', null, $company->id))
                            <span class="btn btn-danger btn-xs delete-span" data-toggle="modal"
                                  data-target="#delete-modal-{{ $media->id }}">
                                <i class="fa fa-trash-o"></i> Delete
                            </span>
                        @endif
                    </div>
                    @if(Auth::user()->hasPermission('MANAGE_COMPANY_INFO', null, $company->id))
                        @include('include.modal', [
                            'id' => $media->id,
                            'deleteTitle' => 'Delete Company Media',
                            'deleteMessage' => 'Are you sure you want to delete the file "' . $media->file_name . '"?',
                            'url' => 'companies/' . $company->id . '/medias/' . $media->id
                        ])
                    @endif
                </td>
            @endif
        </tr>
    @endforeach
    </tbody>
</table>