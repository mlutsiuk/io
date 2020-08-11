@extends('layouts.app')

@section('content')
   <!--Departments SECTION-->
    <section class="">
      <div class="container-fluid">
        <div class="col-12 pt-3 mb-3 bg-white rounded">
          
            <div class="">
                <form class="form-inline mb-3" id="addItem" name="addItem" action="{{ route('admin.departments.store') }}" method="post">
                  @csrf
                  <div class="form-group mr-3">
                    <label for="addtitle" class="my-1 mr-2">Назва:</label>
                    <input type="text" class="form-control" id="addTitle" placeholder="Введіть назву" name="addTitle">
                  </div>
                  <div class="form-group mr-3">
                    <label for="addPlace" class="my-1 mr-2">Корпус:</label>
                    <select name="addPlace" placeholder="Оберіть категорію" id="addPlace" class="form-control" required>
                      @foreach ($categoryList as $categoryOption)
                          <option value="{{ $categoryOption->id }}">{{ $categoryOption->title }}</option>
                      @endforeach
                      </select>
                  </div>
                  <button type="submit" class="btn btn-primary p-2 border rounded"><svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-plus" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M8 3.5a.5.5 0 0 1 .5.5v4a.5.5 0 0 1-.5.5H4a.5.5 0 0 1 0-1h3.5V4a.5.5 0 0 1 .5-.5z"></path>
                    <path fill-rule="evenodd" d="M7.5 8a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1H8.5V12a.5.5 0 0 1-1 0V8z"></path>
                  </svg>
                  <span class="d-none d-md-inline">Додати приміщення</span></button>
                </form>
            </div>
            <div class="d-flex justify-content-between flex-wrap">

            @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
            @endif
                <div class="d-flex justify-content-between flex-wrap">
                  <div class="py-3">
                    <a href="" class="p-2 mr-2 border rounded text-decoration-none">
                      <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-pencil" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M11.293 1.293a1 1 0 0 1 1.414 0l2 2a1 1 0 0 1 0 1.414l-9 9a1 1 0 0 1-.39.242l-3 1a1 1 0 0 1-1.266-1.265l1-3a1 1 0 0 1 .242-.391l9-9zM12 2l2 2-9 9-3 1 1-3 9-9z"></path>
                        <path fill-rule="evenodd" d="M12.146 6.354l-2.5-2.5.708-.708 2.5 2.5-.707.708zM3 10v.5a.5.5 0 0 0 .5.5H4v.5a.5.5 0 0 0 .5.5H5v.5a.5.5 0 0 0 .5.5H6v-1.5a.5.5 0 0 0-.5-.5H5v-.5a.5.5 0 0 0-.5-.5H3z"></path>
                      </svg>
                      <span class="d-none d-md-inline">Редагувати відмічені</span>
                    </a>
                    
                  </div>
                </div>

                    <div class="alert-msg p-3 d-flex justify-content-between">
                      <div></div>
                    </div>
                    @if($paginator->total() > $paginator->count())<!--PAGINATION-->
                      <div class="d-flex justify-content-between">
                          <nav aria-label="Page navigation">
                            {{ $paginator->links() }} 
                          </nav>
                      </div>  
                    @endif
                
          </div>    
              <div id="table" class="table-editable">
                <table class="table table-hover items-table" id="dt-multi-checkbox" >
                  <thead class="thead-light">
                    <tr>
                      <!--th></th-->
                      <!--th>
                        <svg
                          width="1em"
                          height="1em"
                          viewBox="0 0 16 16"
                          class="bi bi-check"
                          fill="currentColor"
                          xmlns="http://www.w3.org/2000/svg"
                        >
                          <path
                            fill-rule="evenodd"
                            d="M10.97 4.97a.75.75 0 0 1 1.071 1.05l-3.992 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.236.236 0 0 1 .02-.022z"
                          />
                        </svg>
                      </th-->
                      <th>id</th>
                      <th>Назва</th>
                      <th>Корпус</th>
                      <th>Дія</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($paginator as $item)
                                @php /** @var \App\Models\InventoryDepartment $item */ @endphp
                                    <tr>
                                      <!--td></td-->
                                      <!--td><input type="checkbox" aria-label="Choose item" /></td-->
                                      <td class="align-middle">{{ $item->id }}</td>    
                                      <td class="align-middle"><a href="" class="update" data-name="title" data-type="text" data-pk="{{ $item->id }}" data-title="Введіть назву">{{ $item->title }}</a></td>        
                                      <td class="align-middle"><a href="" class="update-select" data-name="parent_id" data-type="select2" data-pk="{{ $item->id }}" data-value="{{ $item->parent_id }}" data-title="Оберіть корпус">{{ $item->parentTitle }}</a>
                                      </td>
                                      <td disabled><a href="" class="delete" data-id="{{ $item->id }}"><svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-trash" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                        <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                      </svg></a></td>
                                    </tr>   
                            @endforeach
                  </tbody>
                </table>
              </div>
              <div class="d-flex justify-content-between flex-wrap">
                <div class="py-3">
                  <a href="" class="p-2 mr-2 border rounded text-decoration-none">
                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-pencil" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                      <path fill-rule="evenodd" d="M11.293 1.293a1 1 0 0 1 1.414 0l2 2a1 1 0 0 1 0 1.414l-9 9a1 1 0 0 1-.39.242l-3 1a1 1 0 0 1-1.266-1.265l1-3a1 1 0 0 1 .242-.391l9-9zM12 2l2 2-9 9-3 1 1-3 9-9z"></path>
                      <path fill-rule="evenodd" d="M12.146 6.354l-2.5-2.5.708-.708 2.5 2.5-.707.708zM3 10v.5a.5.5 0 0 0 .5.5H4v.5a.5.5 0 0 0 .5.5H5v.5a.5.5 0 0 0 .5.5H6v-1.5a.5.5 0 0 0-.5-.5H5v-.5a.5.5 0 0 0-.5-.5H3z"></path>
                    </svg>
                    <span class="d-none d-md-inline">Редагувати відмічені</span>
                  </a>
                </div>
                <div>
                  <!--PAGINATION-->
                    <div class="d-flex justify-content-end">
                        <nav aria-label="Page navigation">
                          @if($paginator->total() > $paginator->count())
                          {{ $paginator->links() }}
                          @endif
                        </nav>
                    </div> 
                </div>
              </div>          
          </div>
      </div>
  </section> 
@endsection
@section('ajax')
<script type="text/javascript">
  $(document).ready(function () {
    
    
  });
</script>

@endsection