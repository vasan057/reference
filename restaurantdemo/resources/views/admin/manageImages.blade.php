<div class="panel-body row" id="product_container">
    <div id="myTabContent" class="tab-content">
        <ul class="nav nav-tabs" id="dochide">
            <li class="active"><a href="#details"  data-toggle="tab" aria-expanded="false">Add Image</a></li>
            <li ><a href="#documents" data-toggle="tab" aria-expanded="true">View</a></li>
            </ul>
        <br>
        <div class="tab-pane fade active in" id="details">
            <div class="col-xs-12 card">
                <div class="row">
                    <div class="col-sm-6 col-sm-offset-3 col-xs-12 text-center">
                        <div class="addimage text-center">
                            <div class="form-group">
                                <div>
                                    <img src="img/addimage.png" class="image">
                                </div>
                            </div> 
                        </div>
                        <div class="">
                            <p class="btn btn-sm btn-primary"><i class="fa fa-cloud-upload"></i> Select your file from computer</p>
                            <span class="upload_btn"></span>
                            <input name="fl_manageImage" class="doc-msg" id="fl_restImg" type="file">
                        </div>
                    </div>
                </div>                                                
            </div>
        </div>
        <div class="tab-pane fade" id="documents">
            <div  class="card">
                <input type='hidden' id='txt_manageImg' value='' name="txt_manageImg" />
                @foreach($images as $i => $imgs)
                    <div class="col-md-12 file-select">
                        <div class="col-md-2"><input class="select-img" type="checkbox" value="{{$imgs->image_url}}"> </div>
                        <div class="col-md-4">
                            <img src="{{$imgs->image_url}}" alt=""/></div>
                        <div class="col-md-4">{{$imgs->image_desc}}</div>
                    </div>
                @endforeach
                <div class="row">
                    <div class="col-xs-12">
                        <ul class="pagination pagination-sm">
                            {!! $images->links() !!}
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $('.select-img').click(function(){
    var text = "";
    $('.select-img:checked').each(function(){
        text += $(this).val()+',';
    });
    text = text.substring(0,text.length-1);
    
    $('#txt_manageImg').val(text);
});
</script>
<script>
 $(window).on('hashchange', function() {
        if (window.location.hash) {
            var page = window.location.hash.replace('#', '');
            if (page == Number.NaN || page <= 0) {
                return false;
            }else{
                getData(page);
            }
        }
    });
$(document).ready(function()
{
    $(document).on('click', '.pagination a',function(event)
    {
        $('li').removeClass('active');
        $(this).parent('li').addClass('active');
        event.preventDefault();
        var myurl = $(this).attr('href');
       var page=$(this).attr('href').split('page=')[1];
       getData(page);
    });
});
function getData(page){
        $.ajax(
        {
            url: '?page=' + page,
            type: "get",
            datatype: "html",
            // beforeSend: function()
            // {
            //     you can show your loader 
            // }
        })
        .done(function(data)
        {
            console.log(data);
            $("#product_container").empty().html(data);
            location.hash = page;
            //$("#documents").toggle();
        })
        .fail(function(jqXHR, ajaxOptions, thrownError)
        {
              //alert('No response from server');
        });
}
  </script>