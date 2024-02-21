<div class="col-md-12">
    <div class="management">
        <h1>مدیریت</h1>
        <div class="m_row">
            <h2>افزودن محصول جدید</h2>
            <i class="fa fa-plus" style="font-size: 25px; cursor: pointer;" onclick="openAddArea()"></i>
        </div>
        <div class="m_row AddArea">
            <h3>نام محصول</h3>
            <input type="text" name="product_name" id="product_name">
            <i class="fa fa-check" style="font-size: 25px; color: aquamarine; display: none"></i>
            <i class="fa fa-plus" style="font-size: 25px; cursor: pointer;" onclick="createTable()"></i>
        </div>
        <div class="col-md-6" id="features_area">
            <div class="m_row AddArea">
                <h3>ویژگی ها</h3>
                <input type="text" name="product_price" id="product_price">
                <i class="fa fa-plus" style="font-size: 25px; cursor: pointer;" onclick="addFeature()"></i>
            </div>
        </div>
    </div>
</div>
<style>
    .management {
        background-color: #dde0dd;
        padding: 20px;
        margin: 20px;
        border-radius: 10px;
    }

    .management .m_row {
        background-color: #fff;
        padding: 20px;
        margin: 20px;
        border-radius: 10px;
        display: flex;
        flex-direction: row;
        justify-content: space-between;
        align-items: center;
    }

    .management .AddArea {
        display: none;
    }

    .let_anim_open {
        display: flex !important;
        -webkit-animation: fadeIn 1s;
        animation: fadeIn 1s;
    }

    .let_anim_close {
        display: none;
        -webkit-animation: fadeOut 1s;
        animation: fadeOut 1s;
    }

    @-webkit-keyframes fadeIn {
        0% {
            height: 0px;
        }
        99% {
            height: 50px;
        }
        100% {
            height: auto;
        }
    }

</style>
<script>
    class TABLE {
        constructor(name) {
            this.name = name;
            this.features = {};
        }
        addFeature(feature_name, feature_value = null) {
            this.features[feature_name] = feature_value;
        }
        getFeatures() {
            return this.features;
        }
    }
    class TOC {
        constructor() {
            this.table = null;
        }
        addTable(name) {
            this.table = new TABLE(name);
        }
    }
    const _toc_table =  new TOC();

    function openAddArea() {
        let addArea = document.getElementsByClassName('AddArea');
        console.log(addArea);
        for (let i = 0; i < addArea.length; i++) {
            addArea[i].classList.add('let_anim_open');
        }
    }

    function createTable() {
        let productName = document.getElementById('product_name').value;
        _toc_table.addTable(productName);
        document.getElementsByClassName('fa-check')[0].style.display = 'block';
    }

    function addFeature() {
        let featureArea = document.getElementById('features_area');
        let input = document.getElementById('product_price');
        let newFeature = document.createElement('h3');
        newFeature.innerHTML = input.value;
        featureArea.appendChild(newFeature);
        _toc_table.table.addFeature(input.value);
        input.value = '';
    }
</script>