@extends('Frontend.layouts.default')
@section('content')

<div id='services' class="container-fluid separator">
    <div class="row">
        <h2>{{ $category->category  }}</h2>
        <div class="col-md-8">
            <div class="designarea">
                <div class="shoedit">
                    <img src="" data-angle="1"  id="d" alt/>
                    <img src="" data-angle="2"  id="d" alt/>
                    <img src="" data-angle="3"  id="d" alt/>
                </div>
                <div class="rotatebar">
                    <span id="crotate"><i class="fa fa-rotate-left"></i></span>
                </div>
            </div>
        </div>	 

        <div class="col-md-4">
            <form class="designForm" method="post">
                <input type="hidden" class="spec" name="product_spec" value="" />

                <div class="row">
                    <p>Price : <i class="fa fa-rupee"></i>{{ $category->base_price }}</p>
                    <p>Size : {!! Form::select('size',$sizes) !!}</p>
                    <p>Qty : <input name="qty" class="qty" type="number" value="1" min="1" /></p>
                    <p>Total : <i class="fa fa-rupee"></i><span class="total">{{$category->base_price}}</span> </p>
                </div>



                <div class="custometab">


                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="w50p active"><a href="#material" aria-controls="material" role="tab" data-toggle="tab">MATERIALS</a></li>
                        <li role="presentation" class="w50p"><a href="#Style" aria-controls="Style" role="tab" data-toggle="tab">STYLES</a></li>

                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane active" id="material">
                            <label>Select a Panel to change material of shoe</label>
                            <select name="size" class="form-control select-section">
                                <option>Select</option>
                                <?php foreach ($parts as $key => $value) {
                                    ?> <option><?= $value ?></option> 
                                <?php }
                                ?>
                            </select>
                            <br/>
                            <div class="smaterials">
                                <h5>Select Material</h5>
                                <div class="materials">

                                </div>

                            </div>

                        </div>
                        <div role="tabpanel" class="tab-pane" id="Style">


                        </div>

                    </div>



                </div>

                <div class="row">
                    <button class="btn btn-warning" id="refresh"><i class="fa fa-reload" ></i> Refresh</button>
                    <button class="btn btn-danger" id="saveforlater"><i class="fa fa-heart" ></i> Save for Later</button>
                    <button class="btn btn-success" id="checkout"><i class="fa fa-cart" ></i> Checkout</button>
                </div>

            </form>
        </div>	 
    </div>
</div>
@stop 


@section('myscripts')
<script>




    var spec = {};
    var angles = [1, 2, 3];
    construct();
    showHide(1);
    $(document).ready(function () {

        $("#saveforlater").click(function (e) {
            e.preventDefault();
            $(".spec").val(JSON.stringify(spec));
            $(".designForm").attr("action", '<?= route('save-for-later') ?>');
            $(".designForm").submit();
        });

        $("#refresh").click(function (e) {
            e.preventDefault();
            window.location.href = window.location.href;
        });

        $("#checkout").click(function (e) {
            e.preventDefault();
            $(".designForm").attr("action", '<?= route('checkout') ?>');
            $(".designForm").submit();
        });


        $(".qty").on("input", function () {
            if ($(this).val() > 0)
                $(".total").html($(this).val() * 3000);
        });
        $("#crotate").click(function () {

            var ang = parseInt($(".shoedit img:visible").attr("data-angle")) + 1;
            if ($("[data-angle='" + ang + "']").length > 0) {
                $("[data-angle]").hide();
                $("[data-angle='" + ang + "']").show();
            } else {
                $("[data-angle]").hide();
                $("[data-angle='1']").show();
            }


        });
        $(".select-section").change(function () {
            $.ajax({
                url: "/get-textures",
                data: {part: $(this).val(), shoe: '<?= $category->folder ?>'},
                success: function (data) {
                    console.log(data);
                    $(".materials").html(data);
                    $(".smaterials").show();
                }
            });
        });
    });
    function construct() {
        for (i = 0; i < angles.length; i++) {
            (function (i) {
                setTimeout(function () {
                    $("[data-angle='" + angles[i] + "']").attr("src", "/construct?angle=" + angles[i] + "&shoe=<?= $category->folder ?>")
                    showHide(angles[i]);
                }, i * 1000);
            }(i));
        }
    }

    function change(shoe, part, sub, value) {
        spec[part] = value;
        var qString = "";
        $.each(spec, function (index, val) {
            console.log(index);
            qString += "&spec[" + index.toLowerCase() + "]=" + val;
        });
        for (i = 0; i < angles.length; i++) {

            (function (i) {
                setTimeout(function () {
                    $("[data-angle='" + angles[i] + "']").attr("src", "/construct?angle=" + angles[i] + "&shoe=<?= $category->folder ?>" + qString)
                    showHide(angles[i]);
                }, i * 1000);
            }(i));
        }

    }

    function showHide(angle) {
        $("[data-angle]").hide();
        $("[data-angle='" + angle + "']").show();
    }



</script>

@stop