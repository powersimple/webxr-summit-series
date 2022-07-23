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
//            console.log("meta",m,ros_meta[m])
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
            social +='<a target="_new" class="github" href="'+info.github+'"><i class="fa fa-github social-icon" title="'+this_profile.title+' on GitHub"></i></a>'
        }
        
        if(social != ''){

            card+='<span class="social">'+social+'</span>'
        }
       
        return card;
    } else {
        console.log("no profile info",this_profile)
    }
    

  
    



    
} 
function displayRunOfShowList(runOfShow){
    var list = '<div class="ros-list">'
  
    var now = new Date()
    var showtime = runOfShow.info.event_info.utc_start;
    
    var duration = 0;
    var tense = "future";
    var seconds =  Math.floor(Date.now() / 1000)
    if(seconds>showtime){
        tense = "past"
    }
    var event_date = new Date(parseInt(showtime))
  //  console.log(event_date)
    var session;
    var this_profile;
    var info = {};
    var credential; 
    var session_number = 0;
    var session_order;
    var description;
    var display_event_time


    list += '<h2>'+runOfShow.title+'</h2>'
//    list += '<h2>'+runOfShow.title+'</h2>'
    
    //list +=  event_date

    for (var n = 0; n < runOfShow.sessions.length; n++) { 
        session = runOfShow.sessions[n];
        session_order = session_number
        if(session_number<10){
            session_order = '0'+session_number
        }
        

        if(runOfShow.sessions[n].info.event_info.duration != ''){
            duration = parseInt(runOfShow.sessions[n].info.event_info.duration)*60
            event_time = showtime// this passes it below
            
            display_event_time = localTime(showtime)//converst
            start_time = showtime
            showtime = parseInt(showtime)+duration; //add duration for next 
            //console.log("duration",runOfShow.sessions[n],duration,display_event_time,convertDate(showtime))
                
                
            // console.log("info not undefined",runOfShow.sessions[n],duration,display_event_time,convertDate(showtime))
            }

        list+= '<hr><h4>'
        list += '<span class="session-time">'+display_event_time+' </span><BR>'
        list+= '<span>'+session_order+" - </span> "
     
            
        list+= session.title+'</h4>'
    
        description = session.info.content.replace(/(<([^>]+)>)/gi, "")
    

        list+= '<em style="font-style:italic !important">'+description+'</em><br>'
//        list+='<ul>'
        //list+='<li><strong>Invited Speakers</strong></li>'
        
        for (var p = 0; p < runOfShow.sessions[n].profiles.length; p++) { //speakers
            credential = '' 
         //  credential += '|'   
            this_profile = runOfShow.sessions[n].profiles[p]
            info = this_profile.profile.meta
            if(info.profile_title != undefined){
                credential +=  '<span>'+info.profile_title.trim()+", "+'</span> '
            }
            //credential += '|'
            if(info.company != undefined){
                credential += '<span>'+info.company.trim()+'</span> '
            }
           // credential += '|'

           

            if(info.linkedin != undefined){
              // credential +=' <a target="_new" class="linkedin" href="'+info.linkedin+'"><i class="fa fa-linkedin social-icon" title="'+this_profile.title+' on LinkedIn"></i></a> '

               credential +='<br><a target="_new" class="linkedin" href="'+info.linkedin+'">'
                credential += info.linkedin
//                credential += 'Linkedin'
                credential +='</a> '

            }
            if(info.twitter != undefined){
                   credential +=' <a target="_new" class="twitter" href="'+info.twitter+'"><i class="fa fa-twitter social-icon" title="'+this_profile.title+' on Twitter"></i></a> '
               //credential +='<a target="_new" class="twitter" href="'+info.twitter+'">Twitter</a> '
               }
               
          //     credential += '|'
    

            list+= '<li>'
      //  list+= this_profile.object_id+'|'
            list+= '<strong>'
            
            list+= this_profile.title+", "
        //    list+='|'
            list+= '</strong>'
            list+= credential+'</li>'
        }
  //      list+='</ul>'

        session_number++;
    }
    list+='</div>'
  
    $("#ros-list").html(list)

}

function displayRunOfShowTable(runOfShow){

 //   console.log(runOfShow)
   
    var show = '<h2>'+runOfShow.title+'</h2>'
    var now = new Date()
    var showtime = runOfShow.info.event_info.utc_start;
    var duration = 0;
    var tense = "future";
    var seconds =  Math.floor(Date.now() / 1000)
    if(seconds>showtime){
        tense = "past"
    }
    //console.log("event time",tense, showtime);
    //console.log("TENSE", tense)
    $("#show").html(show)

    var duration = 0;
    var sessions = '<div id="schedule" class="'+event_class+'">'
    var this_profile = ''
    var width_override = ''
    var card_size = 1
    var cell_width = '100%';
    var cols = '';
    var suppress_speaker_list = 0 // session level
    var suppress_event_speaker_list = 0 //event level

    var suppress_unconfimred_speakers = 0 //session level
    var suppress_event_unconfimred_speakers = 1 // event level
    var section_class = ''
    
    var show_speakers = getUrlParameter('show_speakers')
    var show_unconfirmed_speakers = getUrlParameter('show_unconfirmed_speakers')
    for (var n = 0; n < runOfShow.sessions.length; n++) { 
       
       //
      //  console.log("Suppress list",suppress_event_speaker_list)

      //  console.log("session-info",runOfShow.sessions[n].info,showtime)
        if(runOfShow.sessions[n].info != undefined){
        //    console.log("Suppress it",runOfShow.sessions[n].title,suppress_event_speaker_list)
             suppress_event_speaker_list = runOfShow.info.meta.suppress_speaker_list
            section_class = ''
             if(runOfShow.sessions[n].info.meta.section_class != undefined){
                section_class = ''            
            }
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
            sessions += '<div class="row session '+section_class+'">'
            
            sessions += '<div class="col-sm-3 col-md-2">'
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
      
        sessions+= '<div class="col-sm-9 col-md-10">'
        
        sessions += '<h3 class="session-title ">'+runOfShow.sessions[n].info.title+'</h3>'
      //  sessions += '<h5 class="session-blurb ">'+runOfShow.sessions[n].info.content+'</h3>'
        if(runOfShow.sessions[n].info.content != undefined){

            if(runOfShow.sessions[n].info.content != ''){
                sessions += '<div class="session-content ">'+runOfShow.sessions[n].info.content+'</div>'
            }
        }


    //   

    sessions+= '</div>'//time title content
    sessions+= '</div>'//row
        sessions +='<div class="row"><div class="col-12">'//session

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
                width_override = 'interview'
                card_size = 2
                cols='col-sm-6 col-md-3'

            } else {
                width_override = ''
                card_size = 1
                cols='col-sm-6 col-md-3'

            }
            //suppress_speaker_list = 0;
            
            if(runOfShow.sessions[n].info.meta.suppress_speaker_list != undefined){
                suppress_speaker_list = runOfShow.sessions[n].info.meta.suppress_speaker_list;
                
            }
            

        cell_width = 100/runOfShow.sessions[n].profiles.length+'%';
        
//        console.log("show speakers",show_speakers)
        if(suppress_event_speaker_list == 0||show_speakers == 1){
            for (var p = 0; p < runOfShow.sessions[n].profiles.length; p++) { //speakers
                
                this_profile = runOfShow.sessions[n].profiles[p]
             //   console.log('THumb',this_profile.profile,this_profile.profile.thumbnail_url.length)
             

                        sessions += '<div  class="profile-card '+cols+' '+ this_profile.classes +'">'

                // console.log("THIS PROFILE",this_profile)
                    if(this_profile.profile != undefined){
                        if(this_profile.profile.thumbnail_url.length != 0 || show_unconfirmed_speakers == 1){
                                sessions += getProfileThumbnail(this_profile,'thumbnail');
                            /*                   if(card_size == 1){
                                
                                } else {
                                    
                                    sessions += getProfileThumbnail(this_profile,'medium');

                                }*/
                                if((width_override == 'presentation')){
                                    sessions += '</div><div class="col-sm-6 col-md-3">'
                                } else if (width_override == 'inteview'){
                                    
                                }
                                sessions += '<span class="profile-info">'
                            
                                sessions += '<span class="profile-name ' +this_profile.slug+'">'+this_profile.title+'</span>'
                                
                            
                            sessions += getProfileCard(this_profile,event_time);
                        } 
                
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
        $('#ros-accordion').addClass('cards')

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
   // displayRunOfShowTable(runOfShow)
    displayRunOfShowCards(runOfShow)
    if(getUrlParameter('cards') != 'show'){
       
            activateAccordion("#ros-accordion")
        }
    
   
}

function displayRunOfShowCards(runOfShow){
        
    var transparent_cards = getUrlParameter('transcard')
    var card_class = 'card-mode'
    if(card_class != 'trans-card'){
    var show = '<h2>'+runOfShow.title+'</h2>'
    }
    console.log("ROS",runOfShow)

    var showtime = runOfShow.info.event_info.utc_start;
    console.log("SHOWTIME",showtime)
    $("#show").html(show)
    var duration = 0;
    var sessions = '<div id="ros-accordion" class="cards">'
    var this_profile = ''
    var width_override = ''
    var card_size = 1
    var event_date = convertDate(showtime);
    console.log("event date",event_date)
    var counter=0
    var counter_label
    for (var n = 0; n < runOfShow.sessions.length; n++) { 
        if(counter<10){
            counter_label="0"+counter;
        } else {
            counter_label = counter;
        }
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
      if(!transparent_cards){ 
            sessions+='<input type="text" value="'+counter_label+'-'+runOfShow.sessions[n].slug+'" size="0"><BR><BR>'
        }
      counter++
      sessions += '<h3 class="ros"><span class="spacer"></span><span class="session-time"> </span> '+runOfShow.sessions[n].title+'</h3>'

      var card_style= runOfShow.info.meta.event_style_class
      if(transparent_cards){
        card_class = 'trans-card'
        card_style = ''
      } 
        sessions += '<div class="'+card_class+' '+card_style+'">'

      //  sessions += '<img src="/wp-content/uploads/2021/09/BusinessSummitBrandCard.png"+ alt="'+runOfShow.title+'">'
      sessions += '<h4>WebXR Education Summit</h4>'
      
      sessions += '<ul class="session-times card-info">'
        sessions += '<li class="event-date">'+event_date+'</li>'
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
            width_override = 'interview'
            card_size = 2
        } else if(runOfShow.sessions[n].profiles.length == 3){
            width_override = 'three'
            card_size = 2
        } else {
            width_override = ''
            card_size = 1
        }
        if (width_override == 'interview'){
            sessions += '<div class="col-sm-6 '+ width_override+'"><span class="blurb">'+runOfShow.sessions[n].info.content+'</span></div>'
            }
        for (var p = 0; p < runOfShow.sessions[n].profiles.length; p++) { 
            
            this_profile = runOfShow.sessions[n].profiles[p]
                sessions += '<div class="col-sm-3 '+ width_override+'">'
                    sessions += '<div class="profile-card" class="'+ this_profile.classes +'">'
               // console.log("THIS PROFILE",this_profile)
                if(this_profile.profile != undefined){
                    if(card_size == 1){
                        sessions += getProfileThumbnail(this_profile,'thumbnail');
                    } else if (card_class == 'trans-card'){
                        sessions += getProfileThumbnail(this_profile,'medium_large');
                    } else {
                        
                        sessions += getProfileThumbnail(this_profile,'medium');

                    }
                    sessions += '<span class="profile-info">'
                
                    sessions += '<span class="profile-name ' +this_profile.slug+'">'+this_profile.title+'</span>'
                    
    
                sessions += getProfileCard(this_profile,event_time);
                
                console.log("wo",width_override)
                    if(width_override == 'presentation'){

                        if(runOfShow.sessions[n].info.content != undefined){

                            sessions += '<span class="blurb">'+runOfShow.sessions[n].info.content+'</span>'
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

           if(card_class == 'trans-card'){
               if(width_override != 'interview' && width_override!='presentation'){
                    sessions += '<div class="panel-blurb">'+runOfShow.sessions[n].info.content+'</div>'
                }
           }


           sessions += '<div class="card-footer">'
           sessions += '<span class="event-info">'
           sessions += '<a class="rsvp-link" href"'+runOfShow.info.meta.tickets_url+'" target="_new">RSVP: '+runOfShow.info.meta.tickets_url+'</a><B'
           sessions += '<a class="rsvp-link" href"https://webxr.events/" target="_new">//webxr.events</a> | '
           sessions += '<a class="rsvp-link" href"https://twitter.com/webxrawards" target="_new">@webxrawards</a> | '
           sessions += '<a class="rsvp-link" href"https://twitter.com/#webxrsummit" target="_new">#webxrsummit</a><br>'
           sessions += '</span>'
           
           

           sessions += '</div>'
           //sessions += '<span class="host">Hosted by Dr. Karen Alexander</span>'
           sessions += '<span class="sponsor-logo futurewei-logo"><a href="https://futurewei.com" target="_new"  title="Futurewei Technologies"><img src="/wp-content/themes/webxrsummits/images/logo/Futurewei-White-shadow.png" alt="Futurewei Technologies Logo"></a></span>'
       
        sessions += '</div>'
    }
    sessions +='</div>'
    $("#sessions").html(sessions)

   
    if(getUrlParameter('collapse') != 'all'){
       
    //    activateAccordion("#ros-accordion")
    }
    if(getUrlParameter('cards') == 'show'){
        $('#ros-accordion').addClass('cards')

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
function convertDate(unix_timestamp){
    var months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"]
    var date = new Date(unix_timestamp * 1000);
    return date.getDate()+" "+months[date.getMonth()]+" "+date.getFullYear()
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