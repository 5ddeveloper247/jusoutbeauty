jQuery(document).ready(function() {
    $(".summernote").summernote(
        {
        fontSizes: ['8', '9', '10', '11', '12', '14','16','18','20'
        ,'22','23','24','26','28','30','32','33','34','36'],
        // height: 190,
        // minHeight: null,
        // maxHeight: null,
        // focus: !1,
        // fontsize: fontsizes
        // fontSizes: ['8', '9', '10', '11', '12', '14', '18'],
        fontNames: ['Cavolini','Jost'],
        fontNamesIgnoreCheck: ['Cavolini','Jost'],
        // styleTags: ['p', 'h1', 'h2', 'h3', 'h4', 'h5'],
        toolbar: [
            // [groupName, [list of button]]
            ['style', ['style']],
            ['font', ['strikethrough', 'superscript', 'subscript','bold', 'italic', 'clear']],
            ['fontsize', ['fontsize']],
            ['fontname', ['fontname']],
            // ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['height', ['height']],
            ['view', ['codeview']]
        ]
    }
    ), $(".inline-editor").summernote({
        airMode: !0,
    })
}), window.edit = function() {
    $(".click2edit").summernote()
}, window.save = function() {
    $(".click2edit").summernote("destroy")
};
