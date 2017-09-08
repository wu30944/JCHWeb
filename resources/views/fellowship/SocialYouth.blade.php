@if(isset($fellowship_info))
    @foreach($fellowship_info as $info)

        @extends('TmpView.tmp')

        @section('title','社青團契')

        @section('content')
        <section class='container'>

         <!-- Page Heading/Breadcrumbs -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header"><strong>{{$info->name}}</strong>
                            {{-- <small>Subheading</small> --}}
                        </h1>
                        <ol class="breadcrumb">
                            <li><a href="{{url('/')}}">Home</a>
                            </li>
                            <li class="active">{{$info->name}}</li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->

                     <!-- Intro Content -->
                <div class="row">
                    <div class="col-md-6">
                        <img class="img-responsive" src="http://placehold.it/750x450" alt="">
                    </div>
                    <div class="col-md-6">
                        <h2>{{$info->introduction_title}}</h2>
                        {{$info->introduction_content}}
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sed voluptate nihil eum consectetur similique? Consectetur, quod, incidunt, harum nisi dolores delectus reprehenderit voluptatem perferendis dicta dolorem non blanditiis ex fugiat.</p>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Saepe, magni, aperiam vitae illum voluptatum aut sequi impedit non velit ab ea pariatur sint quidem corporis eveniet. Odit, temporibus reprehenderit dolorum!</p>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Et, consequuntur, modi mollitia corporis ipsa voluptate corrupti eum ratione ex ea praesentium quibusdam? Aut, in eum facere corrupti necessitatibus perspiciatis quis?</p>
                    </div>
                </div>
                <!-- /.row -->   

            <!-- Service Tabs -->
            <div class="row">
                <div class="col-lg-12">
                    <h2 class="page-header">Service Tabs</h2>
                </div>
                <div class="col-lg-12">

                    <ul id="myTab" class="nav nav-tabs nav-justified">
                        <li class="active"><a href="#service-one" data-toggle="tab"><i class="fa fa-tree"></i> {{$info->page_one_title}}</a>
                        </li>
                        <li class=""><a href="#service-two" data-toggle="tab"><i class="fa fa-car"></i> {{$info->page_two_title}}</a>
                        </li>
                        <li class=""><a href="#service-three" data-toggle="tab"><i class="fa fa-support"></i> {{$info->page_three_title}}</a>
                        </li>
                        <li class=""><a href="#service-four" data-toggle="tab"><i class="fa fa-database"></i> {{$info->page_four_title}}</a>
                        </li>
                    </ul>

                    <div id="myTabContent" class="tab-content">
                        <div class="tab-pane fade active in" id="service-one">
                            <h4>{{$info->page_one_title}}</h4>
                            <p>{{$info->page_one_content}}</p>
                        </div>
                        <div class="tab-pane fade" id="service-two">
                            <h4>{{$info->page_two_title}}</h4>
                            <p>{{$info->page_two_content}}</p>
                        </div>
                        <div class="tab-pane fade" id="service-three">
                            <h4>{{$info->page_three_title}}</h4>
                            <p>{{$info->page_three_content}}</p>
                        </div>
                        <div class="tab-pane fade" id="service-four">
                            <h4>{{$info->page_four_title}}</h4>
                            <p>{{$info->page_four_content}}</p>
                        </div>
                    </div>

                </div>
            </div>
        </section>
         @stop
     @endforeach
 @endif