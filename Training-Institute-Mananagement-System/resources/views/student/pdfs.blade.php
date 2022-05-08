@extends('layouts.student_app')
@section('title')
Touhid Physics Academic and Admission Care - My Courses
@endsection
@section('FM_pdfs')
active
@endsection
@section('MM_pdfs')
main__menu-active
@endsection
@section('student_css')
<style>
    .pdf__description{
        width: 100%;
        display:flex;
    }
    
    .pdf_title{
        width:85%;
        display: flex;
        align-items: center;
    }
    .pdf_title h3 {
        font-size: 14px;
        color: #222;
    }
    .pdf-icons {
        width: 15%;
        text-align: right;
    }
        
    .pdf-icons svg {
        width: 14px;
        height: 14px;
        margin-left: 10px;
    }
    .pdf-icons svg:hover{
        fill: #5966f3;
    }
</style>
@endsection
@section('student_content')
   
    <div class="top_part">
        <h2 class="page__heading mb-30">
            <a href="{{ url('student/home') }}">
                <svg class="icon icon-keyboard_arrow_left"><use xlink:href="{{ asset('student_asset') }}/icons/icons.svg#icon-keyboard_arrow_left"></use></svg>
            </a>
            Pdfs
        </h2>
    </div>


    <h2 class="page__heading my-30" style="color:#fa80b2;">Latest Pdfs</h2>

    {{-- course access --}}

    @foreach ( view_course_access(Auth::id()) as $view_course_accss )
        @foreach(course_pdfAccess($view_course_accss->course_id) as $pdf_course)
        @if(check_samePdf($pdf_course->pdf_id , Auth::id()) == 'Show')
            <div class="course__list shadow">
                <div class="course__icon">
                    <svg class="icon icon-file-books"><use xlink:href="{{ asset('student_asset') }}/icons/book.svg#icon-books"></use></svg>
                </div>
                <div class="pdf__description">
                    <div class="pdf_title">
                        <h3>{{ $pdf_course->PDF->title }}</h3>
                    </div>
                    <div class="pdf-icons">
                        <a href="{{ url('/TPAAC/storage/app/pdfs/'.$pdf_course->PDF->file) }}" target="_blank"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M12.015 7c4.751 0 8.063 3.012 9.504 4.636-1.401 1.837-4.713 5.364-9.504 5.364-4.42 0-7.93-3.536-9.478-5.407 1.493-1.647 4.817-4.593 9.478-4.593zm0-2c-7.569 0-12.015 6.551-12.015 6.551s4.835 7.449 12.015 7.449c7.733 0 11.985-7.449 11.985-7.449s-4.291-6.551-11.985-6.551zm-.015 3c-2.21 0-4 1.791-4 4s1.79 4 4 4c2.209 0 4-1.791 4-4s-1.791-4-4-4zm-.004 3.999c-.564.564-1.479.564-2.044 0s-.565-1.48 0-2.044c.564-.564 1.479-.564 2.044 0s.565 1.479 0 2.044z"/></svg></a>
                        <a href="{{ url('/download/pdf/file' , $pdf_course->pdf_id ) }}"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M12 21l-8-9h6v-12h4v12h6l-8 9zm9-1v2h-18v-2h-2v4h22v-4h-2z"/></svg></a>
                    </div>
                </div>
            </div>
        @endif
        @endforeach
        
    @endforeach
    <!--view_course_access-->
    @foreach (student_pdfAccess(Auth::id()) as $item )
    
    <div class="course__list shadow">
        <div class="course__icon">
            <svg class="icon icon-file-books"><use xlink:href="{{ asset('student_asset') }}/icons/book.svg#icon-books"></use></svg>
        </div>
        <div class="pdf__description">
            <div class="pdf_title">
                <h3>{{ $item->PDF->title }}</h3>
            </div>
            <div class="pdf-icons">
                <a href="{{ url('/TPAAC/storage/app/pdfs/'.$item->PDF->file) }}" target="_blank"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M12.015 7c4.751 0 8.063 3.012 9.504 4.636-1.401 1.837-4.713 5.364-9.504 5.364-4.42 0-7.93-3.536-9.478-5.407 1.493-1.647 4.817-4.593 9.478-4.593zm0-2c-7.569 0-12.015 6.551-12.015 6.551s4.835 7.449 12.015 7.449c7.733 0 11.985-7.449 11.985-7.449s-4.291-6.551-11.985-6.551zm-.015 3c-2.21 0-4 1.791-4 4s1.79 4 4 4c2.209 0 4-1.791 4-4s-1.791-4-4-4zm-.004 3.999c-.564.564-1.479.564-2.044 0s-.565-1.48 0-2.044c.564-.564 1.479-.564 2.044 0s.565 1.479 0 2.044z"/></svg></a>
                <a href="{{ url('/download/pdf/file' , $item->pdf_id ) }}"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M12 21l-8-9h6v-12h4v12h6l-8 9zm9-1v2h-18v-2h-2v4h22v-4h-2z"/></svg></a>
            </div>
        </div>
    </div>
    @endforeach

@endsection