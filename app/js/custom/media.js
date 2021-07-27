function setMedia(data) {

    for (var m = 0; m < data.length; m++) {
        media[data[m].id] = data[m].data;
    }
    console.log("media", media);
}

function getMediaID(post_id, attr) {
    //console.log(post_id,attr)
    if (posts[id][attr] != undefined) { //is featured_media defined
        var media_id = posts[post_id][attr]

        if (media_id > 0) { // is it set to a value above zero?

            if (media[media_id] != undefined) {
                return media_id
            } else {
                return 0
            }

            // returns 


        } else {
            return 0
        }

    } else {
        return 0
    }


}

function getImageSRC(id, dest, size) { // id = media id

    //  console.log("set image", id, dest, size, media[id])
    if (media[id] != undefined) {


        var full_path = uploads_path + media[id].path // uploads path is in header
        var src = media[id].file; // this defaults to the basic file



        if (media[id].mime == "image/svg+xml") { // if it's an SVG, let the src pass through
            return full_path + src;
        } else { //for real images

            if (size == 'square' || size == 1) { // if for a square area
                src = getSquareVersion(media[id].meta.sizes, dest) // get the size version of the sq
                    //      console.log('square',src)
            } else if (size == 'thumbnail') {
                src = getSquareVersion(media[id].meta.sizes, dest)
                    //       console.log('thumbnail', src)
            } else {

                src = media[id].meta.sizes[size] // returns specified size
                    //console.log('default', size, media[id].meta.sizes,src)
            }

        }

        if (dest == '') { //set path to '' to return the src only
            //console.log("Src return", full_path + src)
            return full_path + src;




        } else { // if dest is specified, set the src to the id and 

            return full_path + src;
        }
        // show the wrapper

    } else {

        return ''
    }

}

function toggleFace(dest, type) {
    //console.log("toggle-face", dest, type, state[dest])
    if (state[dest].transition.face == 'front') {
        return 'back'
    } else {
        return 'front'
    }
}

function loadTemplate(dest, type) { // dest is name of place to put template, type = transition type
    //console.log("load template",dest,type)
    var template = jQuery('#' + dest + "-template").html(); // gets the empty contents of x-template script tag for this dest
    if (type == "flip") { // requires a front back wraper around template contents
        var front = '<div class="card front">' + template + '</div>' // wraps template in a front class
        var back = '<div class="card back">' + template + '</div>' // wrapte template in a back class
        jQuery('#' + dest).html(front + back); // loads both front and back into template into dest
    } else {
        jQuery('#' + dest).html(template); // defaults to empty template contents
    }

}

function clearImageText() {

}

function getAspect(w, h) {
    if (w == h) {
        return 'square'
    } else {
        return Math.round(w / h)
    }

}

function setImageContent(loc, title, caption, desc, alt, src) {

    //console.log("SET IMAGE CONTENT",loc,title,caption,desc,alt,src)
    setTimeout(function() {
        jQuery(loc + " .title").html(title)
        jQuery(loc + " .caption").html(caption)
        jQuery(loc + " .description").html(desc)
        jQuery(loc + " .image").attr('alt', alt)
        jQuery(loc + " .image").attr('src', src)
    }, 250)

}




function transitionImage(dest, type, media_id) {

    if (jQuery('#' + dest).html() == '' || state[dest].transition != type) { // load the template, only if you need to
        state[dest].transition.type = type // if transition type has changed, set it
        loadTemplate(dest, type)
    }
    var aspect = getAspect(parseInt(jQuery("#" + dest).width()), parseInt(jQuery("#" + dest).height())) // pass the sizes of the destination to get the aspect
    var src = getImageSRC(media_id, dest + ' .image', aspect) //returns appropriate image sice.
    if (type == 'flip') {
        var next_face = toggleFace(dest, type) // flip requires front and back, will return opposite based on state
        console.log("FLIP", next_face, dest, type, media_id, src)
        if (next_face == 'back') {
            //  jQuery('#featured').css("transform", "rotateY(180deg)")
        }
        if (media[media_id] != undefined) {
            /*
            //console.log('next face', next_face)
            var flip_chain = {
                flip_out: function () {
                        jQuery(dest).css('transform', 'rotateY(90deg)')
                        console.log('flipout')
                        return flip_chain
                    },
                set_content: function () {
                    setImageContent( '#' + dest + " ." + next_face, //uses "loc" instead of dest to allow for card faces.
                        media[media_id].title,
                        media[media_id].caption,
                        media[media_id].desc,
                        media[media_id].alt,
                        src)
                                            return flip_chain

                },
                flip_in: function() {
                    //jQuery(dest).css('transform', 'rotateY(90deg)')
                    console.log('flipin')

                    return flip_chain
                }
            }
            flip_chain.flip_out().set_content().flip_in()
            */


            setImageContent('#' + dest + " ." + next_face, //uses "loc" instead of dest to allow for card faces.
                media[media_id].title,
                media[media_id].caption,
                media[media_id].desc,
                media[media_id].alt,
                src)

            state[dest].transition.face = next_face
                /*jQuery(function () {
                    jQuery("#"+dest).flip({
                        axis: "y", // y or x
                        reverse: false, // true and false
                        trigger: "hover", // click or hover
                        speed: '250',
                        autoSize: false
                    });
                })*/
                //   console.log('next face', next_face)

        } else {
            setImageContent('#' + dest + " ." + next_face, '', '', '', '', '')
        }
        jQuery('#' + dest).toggleClass('is-flipped')

    }





}




/* GET FEATURED IMAGE BY POST ID */
function setImage(post_id, dest, attr, type, size) {
    //console.log("set image", post_id, size)
    var transition_type = "flip"
    if (posts[post_id] != undefined) { //you passed a post ID, is it there?
        var media_id = getMediaID(post_id, attr) //returns zero if doesn't exist

        if (media_id > 0) { //is media_id
            jQuery('#' + dest).fadeIn()

            // var src = getImageSRC(media_id, dest + '-image', 'square')
            // setMediaText(media_id, dest + '-image')
            // jQuery("#" + dest + '-image').attr("src", src)
            transitionImage(dest, transition_type, media_id)

            //console.log("set", media_id, src)


        } else {
            //console.log("media off", media_id)
            jQuery('#' + dest).fadeOut()
        }

    }


}


function wrapTag(tag, str) {
    return "<" + tag + ">" + str + "</" + tag + ">"
}

function setMediaText(id, dest) { // old

    if (media[id] != undefined) {
        // console.log("caption",media[id]);
        jQuery('#' + dest + "-title").html(media[id].title)
        jQuery('#' + dest + "-caption").html(media[id].caption)
        jQuery('#' + dest + "-description").html(media[id].desc)
        jQuery('#' + dest).attr("alt", media[id].alt);
    } else {
        //console.log("clear media text",dest);
        jQuery('#' + dest + "-title").html('')
        jQuery('#' + dest + "-caption").html('')
        jQuery('#' + dest + "-description").html('')
        jQuery('#' + dest).attr("alt", '');
    }

}

function getSquareVersion(sizes, dest) {

    box = { // object getting the container dimensions
            w: jQuery(dest + "-container").width(),
            h: jQuery(dest + "-container").height()
        }
        // console.log("box",box,"dest"+dest,sizes)

    if (box.w > 1280 || box.h > 1280) { //over 1500 use large
        //    console.log("sq-lg")
        return sizes['sq-lg']
    } else if ((box.w > 250 || box.h > 250) && (box.w <= 1280 || box.h <= 1280)) {
        // console.log("sq-med")
        return sizes['sq-med']
    } else {
        //  console.log("sq-sm")
        return sizes['sq-sm']
    }


}

function setVideo(id, dest) {


    if (media[id] != undefined) {

        var full_path = uploads_path + media[id].path // uploads path is in header
        var src = media[id].file; // this defaults to the basic file

        var video = jQuery(dest + ' video source').attr("src", full_path + src);

        //    console.log("unhide video player")

        jQuery(dest + ' video')[0].load();

        video = jQuery(dest + ' video source').attr("src", full_path + src);
        jQuery(dest).fadeIn()
    } else {
        //    console.log("no video, hide player")
        jQuery(dest).fadeOut();
    }

}

function setScreenImages(screen_images, dest, callback) {
    var images = []
    for (var i = 0; i < screen_images.length; i++) {
        //  console.log("screen image",screen_images[i])
        images.push({
            "src": getImageSRC(screen_images[i], '#screen-image', "square"),
            "data": media[screen_images[i]]
        })

    }
    state.screen_images = images
        //console.log("set ScreenImages", screen_images, dest, images, callback);
        //callback(dest)
        //initParticleTranstion(dest)
    if (images.length > 0 && callback == 'circleViewer') {
        circleViewer(dest, state.screen_images) // buggy
    }
    //  callback(dest,images)



}