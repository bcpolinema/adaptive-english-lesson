@extends('layout-master')
@section('content')

<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="alert alert-success alert-dismissible " role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                    aria-hidden="true">×</span>
            </button>
            <strong>Selamat Datang</strong> di website pembelajaran Bahasa Inggris Polinema!
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-4">
        <div class="thumbnail">
            <div class="image view view-first">
                <img style="width: 100%; display: block;" src="images/topik/listening.jpg" alt="image">
                <div class="mask">
                    <p>Mulai Belajar Listening</p>
                    <div class="tools tools-bottom">
                        <a href="{{route('student.topic.listening')}}"><i class="fa fa-headphones"></i></a>
                    </div>
                </div>
            </div>
            <div class="caption">
                <p><strong>Listening</strong>
                </p>
                <p>Snow and Ice Incoming</p>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="thumbnail">
            <div class="image view view-first">
                <img style="width: 100%; display: block;" src="images/topik/vocabulary.jpg" alt="image">
                <div class="mask no-caption">
                    <div class="tools tools-bottom">
                        <a href="#"><i class="fa fa-link"></i></a>
                        <a href="#"><i class="fa fa-pencil"></i></a>
                        <a href="#"><i class="fa fa-times"></i></a>
                    </div>
                </div>
            </div>
            <div class="caption">
                <p><strong>Vocabulary</strong>
                </p>
                <p>Snow and Ice Incoming</p>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="thumbnail">
            <div class="image view view-first">
                <img style="width: 100%; display: block;" src="images/media.jpg" alt="image">
                <div class="mask no-caption">
                    <div class="tools tools-bottom">
                        <a href="#"><i class="fa fa-link"></i></a>
                        <a href="#"><i class="fa fa-pencil"></i></a>
                        <a href="#"><i class="fa fa-times"></i></a>
                    </div>
                </div>
            </div>
            <div class="caption">
                <p><strong>Grammar</strong>
                </p>
                <p>Snow and Ice Incoming</p>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="thumbnail">
            <div class="image view view-first">
                <img style="width: 100%; display: block;" src="images/media.jpg" alt="image">
                <div class="mask no-caption">
                    <div class="tools tools-bottom">
                        <a href="#"><i class="fa fa-link"></i></a>
                        <a href="#"><i class="fa fa-pencil"></i></a>
                        <a href="#"><i class="fa fa-times"></i></a>
                    </div>
                </div>
            </div>
            <div class="caption">
                <p><strong>Image Name</strong>
                </p>
                <p>Snow and Ice Incoming</p>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="thumbnail">
            <div class="image view view-first">
                <img style="width: 100%; display: block;" src="images/media.jpg" alt="image">
                <div class="mask no-caption">
                    <div class="tools tools-bottom">
                        <a href="#"><i class="fa fa-link"></i></a>
                        <a href="#"><i class="fa fa-pencil"></i></a>
                        <a href="#"><i class="fa fa-times"></i></a>
                    </div>
                </div>
            </div>
            <div class="caption">
                <p><strong>Image Name</strong>
                </p>
                <p>Snow and Ice Incoming</p>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="thumbnail">
            <div class="image view view-first">
                <img style="width: 100%; display: block;" src="images/media.jpg" alt="image">
                <div class="mask no-caption">
                    <div class="tools tools-bottom">
                        <a href="#"><i class="fa fa-link"></i></a>
                        <a href="#"><i class="fa fa-pencil"></i></a>
                        <a href="#"><i class="fa fa-times"></i></a>
                    </div>
                </div>
            </div>
            <div class="caption">
                <p><strong>Image Name</strong>
                </p>
                <p>Snow and Ice Incoming</p>
            </div>
        </div>
    </div>
</div>
@endsection