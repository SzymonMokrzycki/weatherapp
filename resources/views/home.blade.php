@extends('layouts.app')

@section('content')
<div>
    <div class="row justify-content-center">
        <section id="bg">
            <div class="container py-5 h-100">
                <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-md-8 col-lg-6 col-xl-4">

                    <div class="card shadow-lg" style="color: #4B515D; border-radius: 35px;" id="card">
                    <div class="card-body p-4">

                        <div class="d-flex">
                        <h6 class="flex-grow-1" id="cityname"></h6>
                        </div>

                        <div class="d-flex flex-column text-center mt-5 mb-4">
                        <h6 class="display-4 mb-0 font-weight-bold" style="color: #1C2331;" id="temp" value=""> </h6>
                        <span class="small" style="color: #868B94" id="weather"></span>
                        </div>

                        <div class="d-flex align-items-center">
                        <div class="flex-grow-1" style="font-size: 1rem;">
                            <div><i class="fas fa-wind fa-fw" style="color: #868B94;"></i> <span class="ms-1" id="wind"> 
                            </span></div>
                            <div><i class="fas fa-tint fa-fw" aria-hidden="true"></i> <span class="ms-1" id="humidity">  </span>
                            </div>
                        </div>
                        <div>
                            <img id="icon" width="100">
                        </div>
                        </div>

                    </div>
                    </div>

                </div>
                </div>

            </div>
        </section>
    </div>
    <div class="justify-content-center bg-dark border-top vh-100 bg-gradient">
        <div class="row mt-2">    
            <div class="h2 text-white d-flex justify-content-center mb-5">Followed cities:</div>
            <div>
                <table class="table text-white border-top">
                    <tbody id="tab">
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" onload="createChart()" tabindex="-1" id="exampleModal" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content bg-dark text-white">
      <div class="modal-header">
        <h5 class="modal-title" id="titlechart"></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true"></span>
        </button>
      </div>
      <div class="modal-body">
        <canvas id="myChart" width="500" height="500"></canvas>
      </div>
      <div class="modal-footer">
      </div>
    </div>
  </div>
</div>
<div class="modal fade" tabindex="-1" id="exampleModal1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content bg-dark text-white">
      <div class="modal-header">
        <h5 class="modal-title">Choose city to add:</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true"></span>
        </button>
      </div>
      <div class="modal-body" id="tab1">
        <div class="form-outline mb-3">
            <input onkeyup="searchFunction()" placeholder="Search for names.." type="search" id="filter" class="form-control" />
        </div>
        <table class="table text-white border-top" id="table1">
          <tbody id="listcity">
          </tbody>
        </table>
      </div>
      <div class="modal-footer">
        <button id="addcity" type="button" style="width:100px; margin-top:1px;" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#exampleModal1">
            <i class="fa fa-plus-circle" aria-hidden="true"></i> Add
        </button>
      </div>
    </div>
  </div>
</div>
@endsection
