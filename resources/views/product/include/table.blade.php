<table id="products-table" class="table table-bordered table-striped dt-responsive nowrap hover" cellspacing="0"
       width="100%">
    <thead>
    <tr>
        <th>SKU</th>
        <th>Title</th>
        @if(Auth::user()->hasPermission('VIEW_COMPANY'))
            <th>Actions</th>
        @endif
    </tr>
    </thead>
    <tbody>
    @foreach($products as $product)
        <tr>
            {{--SKU--}}
            <td>
                <a href="{{ url('companies/' . $company->id . '/products/' . $product->id) }}">{{ $product->sku }}</a>
            </td>

            {{--Title--}}
            <td>
                <a href="{{ url('companies/' . $company->id . '/products/' . $product->id) }}">{{ $product->title }}</a>
            </td>

            {{--Actions--}}
            @if(Auth::user()->hasPermission('VIEW_COMPANY'))
                <td>
                    <div class="text-center">
                        {{-- Edit --}}
                        @if(Auth::user()->hasPermission('MANAGE_COMPANY_INFO', null, $company->id))
                            <a href="{{ url('companies/' . $company->id . '/products/' . $product->id . '/edit') }}"
                               class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> Edit </a>
                        @endif

                        {{-- Delete --}}
                        @if(Auth::user()->hasPermission('MANAGE_COMPANY_INFO', null, $company->id))
                            <span class="btn btn-danger btn-xs delete-span" data-toggle="modal"
                                  data-target="#delete-modal-{{ $product->id }}">
                                <i class="fa fa-trash-o"></i> Delete
                            </span>
                        @endif
                    </div>
                    @if(Auth::user()->hasPermission('MANAGE_COMPANY_INFO', null, $company->id))
                        @include('include.modal', [
                            'id' => $product->id,
                            'deleteTitle' => 'Delete Product',
                            'deleteMessage' => 'Are you sure you want to delete the product "' . $product->title . '"?',
                            'url' => 'companies/' . $company->id . '/products/' . $product->id
                        ])
                    @endif
                </td>
            @endif
        </tr>
    @endforeach
    </tbody>
</table>