var aboutPolicy = new Vue({

    el: '#about',
    data: {
        save: 'حفظ',
        aboutPolicy: [],
        url: 'http://muthaber-admin.muthaberapp.com/',
        aboutPolicy: {
            about: '',
            policy: ''

        }
    },
    mounted: function () {
        var self = this;
        $.ajax({
            url: self.url + "getaboutpolicy?lang=ar",
            method: 'Get'

        }).done(function (result) {

            self.aboutPolicy = result['0'];

            console.log(self.aboutPolicy[0]);
        });
    },
    methods: {

        updateAbout: function () {
             console.log(this.aboutPolicy);
            var self = this;
            $.ajax({
                url: self.url + "updateabout/" + 1,
                method: 'Put',
                data: this.aboutPolicy

            }).done(function (result) {
                self.$message({
                    showClose: true,
                    message: 'تم بنجاح',
                    type: 'success'
                });
                window.location.reload()
            });
        }
    }

});