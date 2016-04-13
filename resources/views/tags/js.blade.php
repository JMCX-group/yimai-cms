<?php
/**
 * Created by PhpStorm.
 * User: lyx
 * Date: 16/4/13
 * Time: 下午1:58
 */
?>

@section('script')
    <script type="text/javascript">
        var dept_standards = {!! $dept_standards !!};
        var $deptId = $("#dept_id");
        var $deptLv2Id = $("#dept_lv2_id");

        /**
         * Dept Id Select Change
         */
        $deptId.change(function () {
            changeDeptIdSelect();
        });

        /**
         * Dept Lv2 Id Select Change
         */
        $deptLv2Id.change(function () {
            var deptParentId = $deptLv2Id.find("option:selected").attr("parent_id");

            if($deptId.val() == 0) {
                $deptId.val(deptParentId);

                if (deptParentId == 0) {
                    changeDeptIdSelect();
                    alert("Error : 您在二级科室中选中了一个一级科室!\r\n\r\n现已经自动将该选项设置到一级科室.\r\n\r\n请重新选择该一级科室下的二级科室.");
                } else {
                    changeDeptIdSelect($deptLv2Id.val());
                }
            }
        });

        /**
         * Change Dept Id Select Option
         */
        function changeDeptIdSelect(deptLv2IdVal) {
            var deptIdVal = $deptId.val();
            $deptLv2Id.empty();
            $deptLv2Id.append("<option value='0'>无</option>");

            if (deptIdVal == "0") {
                for (var deptKey in dept_standards) {
                    if (dept_standards[deptKey]["parent_id"] == "0") {
                        $deptLv2Id.append("<option value='" + dept_standards[deptKey]["id"] + "' parent_id='0'>" + dept_standards[deptKey]["name"] + "</option>");
                    } else {
                        $deptLv2Id.append("<option value='" + dept_standards[deptKey]["id"] + "' parent_id='" + dept_standards[deptKey]["parent_id"] + "'>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp" + dept_standards[deptKey]["name"] + "</option>");
                    }
                }
            } else {
                for (var deptKey in dept_standards) {
                    if (dept_standards[deptKey]["parent_id"] == deptIdVal) {
                        $deptLv2Id.append("<option value='" + dept_standards[deptKey]["id"] + "'>" + dept_standards[deptKey]["name"] + "</option>");
                    }
                }

                if(deptLv2IdVal){
                    $deptLv2Id.val(deptLv2IdVal);
                }
            }
        }
    </script>
@stop