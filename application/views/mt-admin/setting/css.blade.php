 @extends('mt-admin.master')

 @section('content')
 <div class="row">
                        <div class="col-md-12">
                            <form class="form-horizontal form-row-seperated" action="" id="form_sample_1" method="post">
                                <div class="portlet light">
                                    <div class="portlet-title">
                                        <div class="caption">
                                            <i class="icon-magic-wand"></i>{{$title}} </div>
                                       
                                    </div>
                                    <div class="portlet-body">
                                         @if(!empty($msg))
                                          <div class="alert alert-success alert-dismissable">
                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                                         {{$msg}} </div>
                                        @endif
                            
                            
                                    

                                        <textarea id="code_editor" name="code_editor" >{{base64_decode($res->additional_css)}}</textarea>



                                    </div>
                                      <div class="portlet-title">

                                        <div class="actions btn-set">
                                          
                                           
                                            <button class="btn btn-success" type="submit" name="save" value="1">
                                                <i class="fa fa-check"></i> {{$web->getLable('save')}}</button>
                                                                                  
                                        </div>
                                    </div>
                                </div>
                            </form>
                            
                        </div>
                    </div>
                     @endsection  
 @section('script')
<script src="{{base_url('assets/pages/scripts/components-code-css.js')}}" type="text/javascript"></script>
@endsection  