<template>
    <div class='main-nav'>
    <div class='navbar navbar-inverse'>
        <div class='navbar-header'>
            <button type='button' class='navbar-toggle' data-toggle='collapse' data-target='.navbar-collapse'>
                <span class='sr-only'>Toggle navigation</span>
                <span class='icon-bar'></span>
                <span class='icon-bar'></span>
                <span class='icon-bar'></span>
            </button>
            <a class='navbar-brand'>WebApplication1</a>
        </div>
        <div class='clearfix'></div>
        <div class='navbar-collapse collapse'>
            <ul class='nav navbar-nav'>
                <li>
                    <a>
                        <span class='glyphicon glyphicon-home'></span> Home
                    </a>
                </li>
                <li>
                    <a>
                        <span class='glyphicon glyphicon-education'></span> Counter
                    </a>
                </li>
                <li>
                    <a>
                        <span class='glyphicon glyphicon-th-list'></span> Fetch data
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
</template>

<script>
    export default {
        data(){
            return {
                image: ''
            }
        },
        methods: {
            onImageChange(e) {
                let files = e.target.files || e.dataTransfer.files;
                if (!files.length)
                    return;
                this.createImage(files[0]);
            },
            createImage(file) {
                let reader = new FileReader();
                let vm = this;
                reader.onload = (e) => {
                    vm.image = e.target.result;
                };
                reader.readAsDataURL(file);
            },
            uploadImage(){
                axios.post('/admin/store',{pic: this.image}).then(response => {
                   console.log(response);
                });
            }
        }
    }
</script>

