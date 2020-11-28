$.uploadPreview({
    input_field: "#image-upload", 
    preview_box: "#image-preview",
    label_field: "#image-label",  
    label_default: "Choose File", 
    label_selected: "Change File",
    no_label: false,              
    success_callback: null        
});

$.uploadPreview({
    input_field: "#image-upload-2", 
    preview_box: "#image-preview-2",
    label_field: "#image-label-2",  
    label_default: "Choose File",   
    label_selected: "Change File",  
    no_label: false,                
    success_callback: null          
});

$('input[name=image]').change(function(ev) {
    $('.download-pic__image-preview').addClass('show-preview');
});