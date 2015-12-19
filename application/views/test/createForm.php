<div class="row">
    <div class="col-lg-12 col-md-12">
        <h3>报表</h3>
        <hr/>
    </div>
</div>
<div class="row">
    <div class="col-lg-5 col-md-12 row">
    <li><label class="checkbox-inline">
        <input type="checkbox" id="versionBug" value="10"/>版本Bug数量
    </label></li>
    <li><label class="checkbox-inline">
        <input type="checkbox" id="everyOneSubmitBug" value="1"/>每人提交的bug数
    </label></li>
    <li><label class="checkbox-inline">
        <input type="checkbox" id="everyOneSolveBug" value="2"/>每人解决的bug数
    </label></li>
    <li><label class="checkbox-inline">
        <input type="checkbox" id="everyOneCloseBug" value="3"/>每人关闭的bug数
    </label></li>
    <li><label class="checkbox-inline">
        <input type="checkbox" id="bugSeriousLevel" value="4"/>bug严重程度统计
    </label></li>
    <!--<li><label class="checkbox-inline">
        <input type="checkbox" id="bugSolveMethod" value="5"/>bug解决方案统计
    </label></li>
-->
    <li><label class="checkbox-inline">
        <input type="checkbox" id="bugStatus" value="6"/>bug状态统计
    </label></li>
    <li><label class="checkbox-inline">
        <input type="checkbox" id="bugActivateNum" value="7"/>bug激活次数统计
    </label></li>
    <li><label class="checkbox-inline">
        <input type="checkbox" id="bugType" value="8"/>bug类型统计
    </label></li>
    <li><label class="checkbox-inline">
        <input type="checkbox" id="bugDueUser" value="9"/>指派给统计
    </label></li>
    <br>
    <input id="checkAll" type="button" class="btn btn-primary" value="全选">
    <input id="checkNone" type="button" class="btn btn-primary" value="反选">
    <input id="createForm" type="button" class="btn btn-primary" value="生成报表" onclick="reloadCreateForm()">
</div>
<div class="col-lg-7 col-md-12">
    <?
    if($this->versionBug=="true"){
    ?>
    <div class="panel panel-default">
        <div class="panel-heading">
            版本Bug数量
        </div>
        <div class="panel-body">
            <div id="graphic_holder_10" class="data_pie_holder">
            </div>
            <script type="text/javascript">
                $(function() {
                    var data10 = <?=json_encode($this->dataChartVersionBug)?>;
                    showPie("#graphic_holder_10",data10);
                });
            </script>
        </div>
    </div>
    <?
    }
    ?>
    <?
    if($this->everyOneSubmitBug=="true"){
    ?>
    <div class="panel panel-default">
        <div class="panel-heading">
            每人提交的bug数
        </div>
        <div class="panel-body">
            <div id="graphic_holder_1" class="data_pie_holder">
            </div>
            <script type="text/javascript">
                $(function() {
                    var data1 = <?=json_encode($this->dataChartEveryOneSubmitBug)?>;
                    showPie("#graphic_holder_1",data1);
                });
            </script>
        </div>
    </div>
    <?
    }
    ?>
    <?
    if($this->everyOneSolveBug=="true"){
    ?>
    <div class="panel panel-default">
        <div class="panel-heading">
            每人解决的bug数
        </div>
        <div class="panel-body">
            <div id="graphic_holder_2" class="data_pie_holder">
            </div>
            <script type="text/javascript">
                $(function() {
                    var data2 = <?=json_encode($this->dataChartEveryOneSolveBug)?>;
                    showPie("#graphic_holder_2",data2);
                });
            </script>
        </div>
    </div>
    <?
    }
    ?>
    <?
    if($this->everyOneCloseBug=="true"){
    ?>
    <div class="panel panel-default">
        <div class="panel-heading">
            每人关闭的bug数
        </div>
        <div class="panel-body">
            <div id="graphic_holder_3" class="data_pie_holder">
            </div>
            <script type="text/javascript">
                $(function() {
                    var data3 = <?=json_encode($this->dataChartEveryOneCloseBug)?>;
                    showPie("#graphic_holder_3",data3);
                });
            </script>
        </div>
    </div>
    <?
    }
    ?>
    <?
    if($this->bugSeriousLevel=="true"){
    ?>
    <div class="panel panel-default">
        <div class="panel-heading">
            bug严重程度统计
        </div>
        <div class="panel-body">
            <div id="graphic_holder_4" class="data_pie_holder">
            </div>
            <script type="text/javascript">
                $(function() {
                    var data4 = <?=json_encode($this->dataChartBugSeriousLevel)?>;
                    showPie("#graphic_holder_4",data4);
                });
            </script>
        </div>
    </div>
    <?
    }
    ?>
    <?
    if($this->bugSolveMethod=="true"){
    ?>
    <div class="panel panel-default">
        <div class="panel-heading">
            bug解决方案统计
        </div>
        <div class="panel-body">
            <div id="graphic_holder_5" class="data_pie_holder">
            </div>
            <script type="text/javascript">
                $(function() {
                    var data5 = <?=json_encode($this->dataChartBugSolveMethod)?>;
                    showPie("#graphic_holder_5",data5);
                });
            </script>
        </div>
    </div>
    <?
    }
    ?>
    <?
    if($this->bugStatus=="true"){
    ?>
    <div class="panel panel-default">
        <div class="panel-heading">
            bug状态统计
        </div>
        <div class="panel-body">
            <div id="graphic_holder_6" class="data_pie_holder">
            </div>
            <script type="text/javascript">
                $(function() {
                    var data6 = <?=json_encode($this->dataChartBugStatus)?>;
                    showPie("#graphic_holder_6",data6);
                });
            </script>
        </div>
    </div>
    <?
    }
    ?>
    <?
    if($this->bugActivateNum=="true"){
    ?>
    <div class="panel panel-default">
        <div class="panel-heading">
            bug激活次数统计
        </div>
        <div class="panel-body">
            <div id="graphic_holder_7" class="data_pie_holder">
            </div>
            <script type="text/javascript">
                $(function() {
                    var data7 = <?=json_encode($this->dataChartBugActivateNum)?>;
                    showPie("#graphic_holder_7",data7);
                });
            </script>
        </div>
    </div>
    <?
    }
    ?>
    <?
    if($this->bugType=="true"){
    ?>
    <div class="panel panel-default">
        <div class="panel-heading">
            bug类型统计
        </div>
        <div class="panel-body">
            <div id="graphic_holder_8" class="data_pie_holder">
            </div>
            <script type="text/javascript">
                $(function() {
                    var data8 = <?=json_encode($this->dataChartBugType)?>;
                    showPie("#graphic_holder_8",data8);
                });
            </script>
        </div>
    </div>
    <?
    }
    ?>
    <?
    if($this->bugDueUser=="true"){
    ?>
    <div class="panel panel-default">
        <div class="panel-heading">
            指派给统计
        </div>
        <div class="panel-body">
            <div id="graphic_holder_9" class="data_pie_holder">
            </div>
            <script type="text/javascript">
                $(function() {
                    var data9 = <?=json_encode($this->dataChartBugDueUser)?>;
                    showPie("#graphic_holder_9",data9);
                });
            </script>
        </div>
    </div>
    <?
    }
    ?>
</div>
</div>
<script>
function reloadCreateForm(){
    var data = {
        everyOneSubmitBug:$("#everyOneSubmitBug").prop('checked'),
        everyOneSolveBug:$("#everyOneSolveBug").prop('checked'),
        everyOneCloseBug:$("#everyOneCloseBug").prop('checked'),
        bugSeriousLevel:$("#bugSeriousLevel").prop('checked'),
        bugSolveMethod:$("#bugSolveMethod").prop('checked'),
        bugStatus:$("#bugStatus").prop('checked'),
        bugActivateNum:$("#bugActivateNum").prop('checked'),
        bugType:$("#bugType").prop('checked'),
        bugDueUser:$("#bugDueUser").prop('checked'),
        versionBug:$("#versionBug").prop('checked'),
    };
    var url=req_url_template.str_supplant({ctrller:'test',action:'form/?'+http_build_query(data)});
    gotoUrl(url);
}
$(function(){
    $("#checkAll").click(function(){
        $('input[type="checkbox"]').prop("checked",true);
    });
    // $("#checkNone").click(function(){
    //     $('input[type="checkbox"]').prop("checked",false);
    // });
    $("#checkNone").click(function(){
        $('input[type="checkbox"]').each(function(){
            if($(this).prop("checked")){
                $(this).prop("checked",false);
            }else{
                $(this).prop("checked",true);
            }
        });
    });

    // reloadCreateForm();
});
</script>
