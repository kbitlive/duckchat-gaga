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
        }

        .datetime-picker {
            width: 100%;
        }

    </style>
</head>

<body>

<div class="wrapper" id="wrapper">

    <div class="layout-all-row">

        <div class="list-item-center">

            <div class="item-row datetime-row">
                <input class="datetime-picker" id="datetime-test" type="datetime-local"/>
            </div>

            <div class="item-row datetime-row">
                <input class="datetime-picker" id="datetime-test" type="datetime-local"/>
            </div>

            <div class="item-row datetime-row">
                <input class="datetime-picker" id="datetime-test" type="datetime-local"/>
            </div>


            <div class="item-row">
                <div class="item-body">
                    <div class="item-body-display">

                        <div class="item-body-desc">
                            <input class="" type="button" value="一天前">
                        </div>

                        <div class="item-body-desc">
                            <input class="" type="button" value="一天前">
                        </div>

                        <div class="item-body-desc">
                            <input class="" type="button" value="一天前">
                        </div>

                        <div class="item-body-tail">
                            <input class="" type="button" value="一天前">
                        </div>
                    </div>

                </div>
            </div>
            <div class="division-line"></div>

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




