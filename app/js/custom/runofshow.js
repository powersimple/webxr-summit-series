var ros_meta = {
    timezone: []
}
function runOfShow(menu){
    var show = menu.menu_levels;
    
        if(show.length != undefined){
        
        for (var s = 0; s < show.length; s++) {
            var this_event = show[s]
            this_event.sessions = [];
            this_event.info =events[show[s].object_id]
            for (var n = 0; n < show[s].children.length; n++) {   // sessions the children of shows
                session = show[s].children[n]
                session.info = events[show[s].children[n].object_id]
            //  console.log(n,"info",session.info)
            //   session.info = events[show[s].children[n].object_id]
        

                session.profiles = []
            
                // session.info = events[show[s].sessions[n].object_id]
                for (var p = 0; p < show[s].children[n].children.length; p++) { // profiles

                
                    if(session.object=='profile'){ }
                        this_profile = show[s].children[n].children[p]
                
                        this_profile.profile = profiles[this_profile.object_id];
                        session.profiles.push(this_profile)
                    // console.log("profile",this_profile)
                
                
                }   
                this_event.sessions.push(session)
            this_event.sessions    
            }    
            


        }
        if(getUrlParameter('meta') == 'show'){
            displayMeta()

        }   


        return this_event
    }

}
function displayMeta(){
    var meta = ''
    for(m in ros_meta){
            meta+='<h4>'+m+'</h4>'
            console.log("meta",m,ros_meta[m])
        for(i=0;i<ros_meta[m].length;i++){
            meta+=ros_meta[m][i].id+'|'+ros[m][i].name+"<br>"

        }
    }
    $("#ros_meta").html(meta)

}
function adjustTimeZone(event_time,timezone){
    

    var time = timezone.split("| ")

    var offset = new Date()
    //console.log("Adjust",offset.getTimezoneOffset());
    var adjustment = offset.getTimezoneOffset()
    if(time[0]<0){
        adjustment = adjustment*-1
    }
    var adjust = ((parseInt(time[0])*60)*60)+adjustment; 

    var card = '<span class="timezone">'+convertDate(adjust)+'</span>'

    return card
}
function getProfileCard(this_profile,event_time){
    var title = ''
    var card = ''
    var credential = ''
    var social = ''

    var info = this_profile.profile.meta

    if(info != undefined){
        if(getUrlParameter('timezone') == 'show'){
            var timezone = this_profile.profile.meta.timezone[0]
            if(timezone != undefined){
            
              
                
                card+= adjustTimeZone(event_time,timezone)
            } else{
              
                ros_meta.timezone.push({id:this_profile.object_id,name:this_profile.title})
            }
    
        }
       
        

        if(info.profile_title != undefined){
            credential +=  '<span>'+info.profile_title.trim()+", "+'</span>'
        }
        if(info.company != undefined){
            credential += '<span>'+info.company.trim()+'</span>'
        }
        if(info.twitter != undefined){
          credential += '<span>@'+info.twitter.replace("https://twitter.com/","")+'</span>'
        }
        if(credential != ''){
            card += '<span class="credential">'+credential+'</span>'
        }
        if(info.twitter != undefined){
            social +='<a target="_new" class="twitter" href="'+info.twitter+'"><i class="fa fa-twitter social-icon" title="'+this_profile.title+' on Twitter"></i></a>'
        }
        if(info.linkedin != undefined){
            social +='<a target="_new" class="linkedin" href="'+info.linkedin+'"><i class="fa fa-linkedin social-icon" title="'+this_profile.title+' on LinkedIn"></i></a>'
        }
        if(info.github != undefined){
            social +='<a target="_new" class="github" href="'+info.linkedin+'"><i class="fa fa-github social-icon" title="'+this_profile.title+' on GitHub"></i></a>'
        }
        if(social != ''){
            card+='<span class="social">'+social+'</span>'
        }
       
        return card;
    } else {
        console.log("no profile info",this_profile)
    }
    

  
    



    
} 


function displayRunOfShowTable(runOfShow){

 //   console.log(runOfShow)
   
    var show = '<h2>'+runOfShow.title+'</h2>'
    var now = new Date()
    var showtime = runOfShow.info.event_info.utc_start;
    var tense = "future";
    if(now>showtime){
        tense = "past"
    }
    console.log("TENSE", tense)
    $("#show").html(show)
    var duration = 0;
    var sessions = '<div id="schedule">'
    var this_profile = ''
    var width_override = ''
    var card_size = 1
    var cell_width = '100%';
    var cols = '';
    for (var n = 0; n < runOfShow.sessions.length; n++) { 
      //  console.log("session-info",runOfShow.sessions[n].info,showtime)
        if(runOfShow.sessions[n].info != undefined){
            
            if(runOfShow.sessions[n].info.event_info.duration != ''){
            duration = parseInt(runOfShow.sessions[n].info.event_info.duration)*60
            event_time = showtime// this passes it below
            
            display_event_time = localTime(showtime)//converst
            start_time = showtime
            showtime = parseInt(showtime)+duration; //add duration for next 
            //console.log("duration",runOfShow.sessions[n],duration,display_event_time,convertDate(showtime))
                
                }
            // console.log("info not undefined",runOfShow.sessions[n],duration,display_event_time,convertDate(showtime))
            }
    //        console.log(runOfShow.sessions[n],duration,display_event_time,convertDate(showtime))
            sessions += '<div class="row session">'
            
            sessions += '<div class="col-sm-2 col-md-1">'
            if(tense == 'future'){
            sessions += '<h3 class="ros"><span class="spacer"></span><span class="session-time">'+display_event_time+' </span></h3>'
            } else {
                if(runOfShow.sessions[n].info.meta.embed_video_url != undefined){
                    sessions += '<a href="#" class="watch video-button" onclick="playVideo(\''+runOfShow.sessions[n].info.meta.embed_video_url+'\')" class="watch"><i title="WATCH" class="fa fa-youtube"></i><br> Watch</a>'
                }
            }
          //  sessions += '<div class="card-mode">'
        //  sessions += '<img src="/wp-content/uploads/2021/09/BusinessSummitBrandCard.png"+ alt="'+runOfShow.title+'">'
        /*
        sessions += '<ul class="session-times card-info">'
        sessions += '<li class="event-date">14 September 2021</li>'
 
        sessions += '<li><span>PDT</span><BR>'+convertDateTime(start_time,-7) +'</li>'
        sessions += '<li><span>EDT</span><BR>'+convertDateTime(start_time,-4) +'</li>'
        sessions += '<li><span>UTC</span><BR>'+convertDateTime(start_time,0) +'</li>'
        sessions += '<li><span>BST</span><BR>'+convertDateTime(start_time,1) +'</li>'
        sessions += '<li><span>CEST</span><BR>'+convertDateTime(start_time,2) +'</li>'
        sessions += '<li><span>CST</span><BR>'+convertDateTime(start_time,8) +'</li>'
        sessions+= '</ul>'
        */
        sessions+= '</div>'
      
        sessions+= '<div class="col-sm-3 col-md-2">'
        
        sessions += '<h3 class="session-title ">'+runOfShow.sessions[n].title+'</h3>'
    //   

    sessions+= '</div>'
        sessions +='<div class="col-sm-6 col-md-8">'//session

            sessions += '<div class="row" class="speaker-list">'
            width_override = ''
            
            if(runOfShow.sessions[n].profiles.length == 5){
                width_override = 'fifth'
                card_size = 1
                cols='fifth'
            } else if(runOfShow.sessions[n].profiles.length == 1){
                width_override = 'presentation'
                card_size = 2
                cols='col-sm-6 col-md-3'

            } else if(runOfShow.sessions[n].profiles.length == 2){
                width_override = 'pair'
                card_size = 2
                cols='col-sm-6 col-md-3'

            } else {
                width_override = ''
                card_size = 1
                cols='col-sm-6 col-md-3'

            }

            
        

cell_width = 100/runOfShow.sessions[n].profiles.length+'%';

        for (var p = 0; p < runOfShow.sessions[n].profiles.length; p++) { //speakers
            
            this_profile = runOfShow.sessions[n].profiles[p]
               
                    sessions += '<div  class="profile-card '+cols+' '+ this_profile.classes +'">'

               // console.log("THIS PROFILE",this_profile)
                if(this_profile.profile != undefined){
                    sessions += getProfileThumbnail(this_profile,'thumbnail');
                 /*                   if(card_size == 1){
                      
                    } else {
                        
                        sessions += getProfileThumbnail(this_profile,'medium');

                    }*/
                    if((width_override == 'presentation') || (width_override == 'pair')){
                        sessions += '</div><div class="col-sm-6 col-md-3">'
                    }
                    sessions += '<span class="profile-info">'
                
                    sessions += '<span class="profile-name ' +this_profile.slug+'">'+this_profile.title+'</span>'
                    
                   
                sessions += getProfileCard(this_profile,event_time);
                
                if(width_override == 'presentation'){
                   sessions += '</div><div class="col-sm-12 col-md-8 talk-blurb">'
                
             //       console.log(this_profile.profile);
                if(this_profile.profile.meta.talk_description != undefined){
                    sessions += '<span class="blurb">'+this_profile.profile.meta.talk_description+'</span>'
                }
            }
                sessions += '</span>'
                
                } else {
                    if(getUrlParameter('hold') == 'show'){
                        sessions += '<span class="profile-name">'+this_profile.title+'</span>'
                   }
                   
                }

                
                



                sessions += '</div>'


           }
           
           sessions += '</div>'
           sessions += '</div>'


           

          
        sessions += '</div>'
    }
    sessions +='</div>'
    $("#ros-table").html(sessions)

   
    if(getUrlParameter('collapse') != 'all'){
       
    //    activateAccordion("#ros-accordion")
    }
    if(getUrlParameter('cards') == 'show'){
    //    $('#ros-accordion').addClass('cards')

   }

}

function playVideo(src){
   $("#video-player").attr("src",src)

}

function getProfileThumbnail(this_profile,size){
   
    var profile_thumbnail = '<div class="profile-thumbnail">'

    if(this_profile.profile.thumbnail_url != undefined){
        var path = this_profile.profile.thumbnail_url[size] 
        if(path != undefined){
        profile_thumbnail +='<img src="'+path+'" alt="'+this_profile.title+'" title="'+this_profile.title+'">'
        }
    }
    profile_thumbnail += '</div>'
    return profile_thumbnail;
}

function displayRunOfShow(runOfShow){
    displayRunOfShowTable(runOfShow)
    displayRunOfShowCards(runOfShow)
    if(getUrlParameter('cards') != 'show'){
       
        //    activateAccordion("#ros-accordion")
        }
    
   
}

function displayRunOfShowCards(runOfShow){
        
    var show = '<h2>'+runOfShow.title+'</h2>'

    var showtime = runOfShow.info.event_info.utc_start;
    console.log("SHOWTIME",showtime)
    $("#show").html(show)
    var duration = 0;
    var sessions = '<div id="ros-accordion" class="cards">'
    var this_profile = ''
    var width_override = ''
    var card_size = 1
    
    for (var n = 0; n < runOfShow.sessions.length; n++) { 

        if(runOfShow.sessions[n].info != undefined){
            
            if(runOfShow.sessions[n].info.event_info.duration != ''){
            duration = parseInt(runOfShow.sessions[n].info.event_info.duration)*60
            event_time = showtime// this passes it below
            display_event_time = localTime(showtime)//converst
            start_time = showtime
            showtime = parseInt(showtime)+duration; //add duration for next 
            //console.log("duration",runOfShow.sessions[n],duration,display_event_time,convertDate(showtime))
                
            }
           // console.log("info not undefined",runOfShow.sessions[n],duration,display_event_time,convertDate(showtime))
        }
//        console.log(runOfShow.sessions[n],duration,display_event_time,convertDate(showtime))
      //  console.log("title time",display_event_time,runOfShow.sessions[n].title)
        sessions += '<h3 class="ros"><span class="spacer"></span><span class="session-time"> </span> '+runOfShow.sessions[n].title+'</h3>'
        sessions += '<div class="card-mode">'
      //  sessions += '<img src="/wp-content/uploads/2021/09/BusinessSummitBrandCard.png"+ alt="'+runOfShow.title+'">'
      sessions += '<ul class="session-times card-info">'
        sessions += '<li class="event-date">12 October 2021</li>'
       sessions += '<li><span>Los Angeles</span><BR>'+convertDateTime(start_time,-7) +'</li>'
        sessions += '<li><span>New York</span><BR>'+convertDateTime(start_time,-4) +'</li>'
        sessions += '<li><span>UTC</span><BR>'+convertDateTime(start_time,0) +'</li>'
        sessions += '<li><span>London</span><BR>'+convertDateTime(start_time,1) +'</li>'
        sessions += '<li><span>Paris</span><BR>'+convertDateTime(start_time,2) +'</li>'
        sessions += '<li><span>Beijing</span><BR>'+convertDateTime(start_time,8) +'</li>'
      
      sessions+= '</ul>'
        sessions += '<h3 class="card-info">'+runOfShow.sessions[n].title+'</h3>'
     //   

        sessions += '<div id="speaker-list" class="row">'
        width_override = ''
        
        if(runOfShow.sessions[n].profiles.length == 5){
            width_override = 'fifth'
            card_size = 1
        } else if(runOfShow.sessions[n].profiles.length == 1){
            width_override = 'presentation'
            card_size = 2
        } else if(runOfShow.sessions[n].profiles.length == 2){
            width_override = 'pair'
            card_size = 2
        } else {
            width_override = ''
            card_size = 1
        }

        for (var p = 0; p < runOfShow.sessions[n].profiles.length; p++) { 
            
            this_profile = runOfShow.sessions[n].profiles[p]
                sessions += '<div class="col-sm-3 '+ width_override+'">'
                    sessions += '<div class="profile-card" class="'+ this_profile.classes +'">'
               // console.log("THIS PROFILE",this_profile)
                if(this_profile.profile != undefined){
                    if(card_size == 1){
                        sessions += getProfileThumbnail(this_profile,'thumbnail');
                    } else {
                        
                        sessions += getProfileThumbnail(this_profile,'medium');

                    }
                    sessions += '<span class="profile-info">'
                
                    sessions += '<span class="profile-name ' +this_profile.slug+'">'+this_profile.title+'</span>'
                    
    
                sessions += getProfileCard(this_profile,event_time);
                
                
                    if(width_override == 'presentation'){

                        if(this_profile.profile.meta.talk_description != undefined){
                            sessions += '<span class="blurb">'+this_profile.profile.meta.talk_description+'</span>'
                        }
                    }
                sessions += '</span>'
                
                } else {
                    if(getUrlParameter('hold') == 'show'){
                        sessions += '<span class="profile-name">'+this_profile.title+'</span>'
                   }
                   
                }

                
                



                sessions += '</div>'

                sessions += '</div>'

           }
           sessions += '</div>'

           sessions += '<div class="card-footer">'
           sessions += '<span class="event-info">'
           sessions += '<a class="rsvp-link" href"https://bit.ly/WebXRDesignSummit21" target="_new">RSVP: https://bit.ly/WebXRDesignSummit21</a><br>'
           sessions += '<a class="rsvp-link" href"https://webxr.events/" target="_new">//webxr.events</a> | '
           sessions += '<a class="rsvp-link" href"https://twitter.com/webxrawards" target="_new">@webxrawards</a> | '
           sessions += '<a class="rsvp-link" href"https://twitter.com/#webxrsummit" target="_new">#webxrsummit</a><br>'
           sessions += '</span>'
           sessions += '<span class="sponsor-logo futurewei-logo"><a href="https://futurewei.com" target="_new"  title="Futurewei Technologies"><img src="/wp-content/uploads/2021/09/Futurewei-White.png" alt="Futurewei Technologies Logo"></a></span>'
           

           sessions += '</div>'
           

          
        sessions += '</div>'
    }
    sessions +='</div>'
    $("#sessions").html(sessions)

   
    if(getUrlParameter('collapse') != 'all'){
       
    //    activateAccordion("#ros-accordion")
    }
    if(getUrlParameter('cards') == 'show'){
    //    $('#ros-accordion').addClass('cards')

   }

}
jQuery(document).ready(function() {

  

});
function activateAccordion(id){
    console.log("triggered")
    jQuery(id).accordion({
        header: "h3",
        collapsible: false,
        autoHeight: true,
        heightStyle:"content",
        navigation: true
    });

}

function displayShow(){

}
function displaySession(){
    
}
function displayProfile(){
    
}
function utcDate(d){
    d= new Date(d);

    return  d.getUTCMonth()+1+' '+ d.getUTCDate() + ' '+ d.getUTCFullYear()
 
}
function utcTime(d,offset){
    d= new Date(d);
    var tail= 'GMT', D= [d.getUTCFullYear(), d.getUTCMonth()+1, d.getUTCDate()],
    T= [d.getUTCHours(), d.getUTCMinutes(), d.getUTCSeconds()];
    if(+T[0]> 12){
        T[0]-= 12;
        tail= ' pm '+tail;
    }
    else tail= ' am '+tail;
    var i= 3;
    while(i){
        --i;
        if(D[i]<10) D[i]= '0'+D[i];
        if(T[i]<10) T[i]= '0'+T[i];
    }
    return D.join('/')+' '+T.join(':')+ tail;
}
function localTime(unix_timestamp){
    
    // Create a new JavaScript Date object based on the timestamp
    // multiplied by 1000 so that the argument is in milliseconds, not seconds.

    var date = new Date(unix_timestamp * 1000);

    var utc_offset_hours = date.getTimezoneOffset()/60
    
    
    // Hours part from the timestamp
    var hours = parseInt(date.getHours())


    // Minutes part from the timestamp
    var minutes = "0" + date.getMinutes();
    // Seconds part from the timestamp
    var seconds = "0" + date.getSeconds();
    
    // Will display time in 10:30:23 format
    return hours + ':' + minutes.substr(-2);
}
function convertDate(unix_timestamp,offset){

}
function convertDateTime(unix_timestamp,offset){
    
    // Create a new JavaScript Date object based on the timestamp
    // multiplied by 1000 so that the argument is in milliseconds, not seconds.

    var date = new Date(unix_timestamp * 1000);

    var utc_offset_hours = date.getTimezoneOffset()/60


    
    // Hours part from the timestamp
    var hours = parseInt(date.getHours())
    var hours_adjusted = hours+utc_offset_hours
   
    var utc_adjusted = hours_adjusted+offset
    if(utc_adjusted>=24){
        utc_adjusted = utc_adjusted-24
    }
 

    // Minutes part from the timestamp
    var minutes = "0" + date.getMinutes();
    // Seconds part from the timestamp
    var seconds = "0" + date.getSeconds();
    
    // Will display time in 10:30:23 format
    return parseInt(utc_adjusted) + ':' + minutes.substr(-2);
}

$(".video-button").on('click', function(event){
    console.log("THIS",$(this).data('url'))

});