/**
 * Created by Administrator on 2017/12/1.
 */





//function createFreQ(a){
//
//    var count=$('#itm').children().length+1;
//    var fdiv=$('<div class=""></div>');
//    var prevdiv=$('<div class="previou"></div>');
//    var title=$('<div class="div_title_question_all"></div>');
//    var topic=$('<div class="div_topic_question"></div>');
//    var divtitlt=$('<div class="div_title_question"></div>');
//    var spantop=$('<span>'+count+'</span>');
//    var span=$('<span>.请在此输入问题标题</span>');
//    var span2=$('<span style="color: red">&nbsp *</span>');
//    divtitlt.append(spantop,span,span2);
//    title.append(divtitlt,topic);
//    prevdiv.append(title);
//
//    var radiodiv=$('<div  class="div_table_radio_question"></div>');
//    var ul=$('<ul></ul>');
//    var li=$('<li><input type="radio" /><label>选项13</label></li>');
//    ul.append(li);
//    radiodiv.append(ul);
//    prevdiv.append(radiodiv);
//    fdiv.append(prevdiv);
//    var buttondiv=$('<div></div>');
//    var a1=$('<a href="javascript:void(0);" class="btn btn-default" onclick="ok()"><span class="glyphicon glyphicon-ok"></span><span>完成</span></a>');
//    var a2=$('<a href="javascript:void(0);" class="btn btn-default"><span class="glyphicon glyphicon-star-empty"></span><span>复制</span></a>');
//    var a3=$('<a href="javascript:void(0);" class="btn btn-default" onclick="delect()"><span class="glyphicon glyphicon-trash"></span><span>删除</span></a>');
//    var a4=$('<a href="javascript:void(0);" class="btn btn-default" onclick="up()"><span class="glyphicon glyphicon-arrow-up"></span><span>上移</span></a>');
//    var a5=$('<a href="javascript:void(0);" class="btn btn-default" onclick="down()"><span class="glyphicon glyphicon-arrow-down"></span><span>下移</span></a>');
//    var a6=$('<a href="javascript:void(0);" class="btn btn-default"><span class="glyphicon glyphicon-collapse-up"></span><span>最前</span></a>');
//    var a7=$('<a href="javascript:void(0);" class="btn btn-default"><span class="glyphicon glyphicon-collapse-down"></span><span>最后</span></a>');
//    buttondiv.append(a1,a2,a3,a4,a5,a6,a7);
//    prevdiv.append(buttondiv);
//    fdiv.append(prevdiv);
//    var divwrite=$('<div class="write"></div>');
//    var divhead=$('<div></div>');
//    var spandiv=$('<div class="spanLeft"></div>');
//    var span3=$('<span style="float:left;"><b>标题</b><a href="#">应用</a></span>');
//    var span4=$('<span>设置标题字体、插入图片视频</span>');
//    spandiv.append(span3,span4);
//    var inputd=$('<div style="width: 395px;"><div><textarea  data-toggle="tooltip" data-placement="auto" title="例如：您最喜欢的车型是什么？"></textarea></div></div>');
//    spandiv.append(inputd);
//    divhead.append(spandiv);
//    divwrite.append(divhead);
//    fdiv.append(divwrite);
//
//
//    var divx=$('<div></div>');
//    var table=$('<table class="table table-bordered table-responsive table-condensed"></table>');
//    var tr1=$('<tr style="background-color: rgb(225, 224, 224)"></tr>');
//    var td1=$('<td>选项文字</td>');
//    var td2=$('<td>图片</td>');
//    var td3=$('<td>说明</td>');
//    var td4=$('<td>允许填空</td>');
//    var td5=$('<td>跳题</td>');
//    var td6=$('<td>默认</td>');
//    var td7=$('<td>分组</td>');
//    var td8=$('<td>操作</td>');
//    tr1.append(td1,td2,td3,td4,td5,td6,td7,td8);
//    var tr2=$('<tr></tr>');
//    var td11=$('<td><input type="text" value="选项2"></td>');
//    var td12=$('<td><span></span></td>');
//    var td13=$('<td><span></span></td>');
//    var td14=$('<td><input type="checkbox"></td>');
//    var td15=$('<td></td>');
//    var td16=$('<td><input type="checkbox"></td>');
//    var td17=$('<td>分组</td>');
//    var td18=$('<td><span class="glyphicon glyphicon-plus" onclick="add()"></span> <span class="glyphicon glyphicon-minus" onclick="remov()"></span> <span class="glyphicon glyphicon-chevron-up" onclick="toup()"></span> <span  class="glyphicon glyphicon-chevron-down" onclick="todown()"></span></td>');
//    tr2.append(td11,td12,td13,td14,td15,td16,td17,td18);
//    table.append(tr1,tr2);
//
//    divx.append(table);
//    divwrite.append(divx);
//    var fina=$('<a href="javascript:void(0);" onclick="ok()" class="btn btn-default btn_orange">完成编辑</a>');
//    divwrite.append(fina);
//    fdiv.append(divwrite);
//    $('#itm').append(fdiv)
//}
//function ok(){
//    console.log($(event.target).parent().parent().parent().next().remove())
//}
//function delect()
//{
//
//    $(event.target).parent().parent().parent().parent().remove();
//}
//function up()
//{
//
//   $(event.target).parent().parent().parent().parent().prev().before(  $(event.target).parent().parent().parent().parent());
//}
//function down()
//{
//    $(event.target).parent().parent().parent().parent().prev().after(  $(event.target).parent().parent().parent().parent());
//}
//        /*
//         * 选项
//         * */
//function remov()
//{
//    $(event.target).parent().parent().remove();
//}
//function toup()
//{
//    $(event.target).parent().parent().prev().before($(event.target).parent().parent());
//    console.log($(event.target).parent().parent());
//}
//function add()
//{
//    var length=$(event.target).parent().parent().parent().children().length;
//    var tr2=$('<tr></tr>');
//    var td11=$('<td><input type="text" value="选项'+length+'"></td>');
//    var td12=$('<td><span></span></td>');
//    var td13=$('<td><span></span></td>');
//    var td14=$('<td><input type="checkbox"></td>');
//    var td15=$('<td></td>');
//    var td16=$('<td><input type="checkbox"></td>');
//    var td17=$('<td>分组</td>');
//    var td18=$('<td><span class="glyphicon glyphicon-plus" onclick="add()"></span> <span class="glyphicon glyphicon-minus" onclick="remov()"></span> <span class="glyphicon glyphicon-chevron-up" onclick="toup()"></span> <span  class="glyphicon glyphicon-chevron-down" onclick="todown()"></span></td>');
//    tr2.append(td11,td12,td13,td14,td15,td16,td17,td18);
//    $(event.target).parent().parent().after(tr2);
//}
//function todown(){
//
//    $(event.target).parent().parent().next().after( $(event.target).parent().parent());
//}
