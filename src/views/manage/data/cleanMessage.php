<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title><?php echo $title; ?></title>

    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <link rel="stylesheet" href="../../public/manage/config.css"/>

    <style>

        .datetime-row {
            margin: 31pt 10pt 0 10pt;
            text-align: center;
        }

        .datetime-picker {
            width: 100%;
            height: 40px;
            background: rgba(255, 255, 255, 1);
            border-radius: 4px;
            border: 1px solid;
            border-color: #DFDFDF;
        }

        .datetime-label {
            margin-top: 82px;
            margin-bottom: 19px;
            text-align: center;
        }

        .select-label {
            font-size: 12px;
            color: #999999;
        }

        .datetime-select-button {
            width: 60px;
            height: 60px;
            border-radius: 2px;
            border: 1px solid;
            border-color: #979797;
            background: rgba(245, 245, 245, 1);
        }

        .item-body-datetime-select {
            margin: 0 40px 64px 40px;
            display: flex;
            justify-content: space-between;
        }

        .clean-button {
            margin: 0 10px 0 10px;
            margin-right: 50px;
            width: 100%;
            height: 44px;
            background: rgba(76, 59, 177, 1);
            border-radius: 4px;
            font-size: 16px;
            font-family: PingFangSC-Regular;
            font-weight: 400;
            color: rgba(255, 255, 255, 1);
        }

    </style>
</head>

<body>

<div class="wrapper" id="wrapper">

    <div class="layout-all-row">

        <div class="list-item-center">

            <div class="datetime-row">
                <input class="datetime-picker" id="datetime-test" type="datetime-local"/>
            </div>

            <div class="datetime-label">
                <label class="select-label">快速选择删除某一个时间之前的所有“二人”、“群组”消息</label>
            </div>

            <div class="item-body-datetime-select">

                <div class="">
                    <input class="datetime-select-button" type="button" value="一天前"/>
                </div>

                <div class="">
                    <input class="datetime-select-button" type="button" value="一周前"/>
                </div>

                <div class="">
                    <input class="datetime-select-button" type="button" value="一月前"/>
                </div>

                <div class="">
                    <input class="datetime-select-button" type="button" value="所有的"/>
                </div>
            </div>

            <div class="" style="margin-right: 20px">
                <button class="clean-button">删除消息</button>
            </div>

        </div>
    </div>

</div>

<script type="text/javascript" src="../../public/jquery/jquery-3.3.1.min.js"></script>
<script src="../../../public/sdk/zalyjsNative.js"></script>

<script type="text/javascript">

    function getLanguage() {
        var nl = navigator.language;
        if ("zh-cn" == nl || "zh-CN" == nl) {
            return 1;
        }
        return 0;
    }

    /**
     *
     * @param type u2/group
     * @param dateTime 时间
     */
    function cleanMessage(type, dateTime) {

    }

</script>

</body>
</html>




