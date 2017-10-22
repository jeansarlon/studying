@extends('layouts.main')
@section('content')
   <h1 class="page-header"><i class="fa fa-fw fa-list"></i>Categorias</h1>

   {{-- Alerts --}}
   @include('partials.alerts')

   <div class="row">
      <div class="col-md-6">
         {{-- Busca --}}
         @include('partials.search', ['search'=>$search])
         @if(count($categories) > 0)
            {{-- List --}}
            <table class="table table-bordered table-striped table-hover" id="gridCategorias">
               <thead>
                  <tr>
                     <th>ID</th>
                     <th>Nome</th>
                     <th>Criada em</th>
                     <th>Ações</th>
                  </tr>
               </thead>
               <tbody>
               @foreach ($categories as $cat)
                  <tr>
                     <td>{!! $cat['id'] !!}</td>
                     <td>{!! $cat['name'] !!}</td>
                     <td>{!! $cat['created_at'] !!}</td>
                     <td>
                        <a href="{!!route('category.edit', $cat['id']) !!}" class="btn btn-xs btn-primary">Editar</a>
                        <a href="{!!route('category.destroy', $cat['id']) !!}" class="btn btn-xs btn-danger btn-excluir">Excluir</a>
                     </td>
                  </tr>
               @endforeach
               </tbody>
            </table>
            {{-- Pagination --}}
            <p>Pagina: {!! $categories->currentPage() !!} de {!! $categories->lastPage() !!}</p>
            <div class="row">
               <div class="col-md-12 text-center">
                  {!!$categories->render()!!}
               </div>
            </div>
            {{-- / Pagination --}}
            {{-- / List --}}
         @else
            <h5>Nenhuma categoria encontrada</h5>
         @endif
      </div>
      <div class="col-md-6">
         <div class="well">
            {!! Form::model($category, ['route' => ['category.update', $category->id] ]) !!}
               @include('category.partials.form')
            {!! Form::close() !!}
         </div>
      </div>
   </div>

   @section('scripts')
      @parent
      <script>
         $(document).ready(function() {
            $('#gridCategorias').on('click', '.btn-excluir', function(event) {
               var btn = $(event.currentTarget),
               confirm = window.confirm('Excluir a categoria?');
               if (!confirm) {
                  event.preventDefault();
               }
            });
         });
      </script>
   @stop
@stop
