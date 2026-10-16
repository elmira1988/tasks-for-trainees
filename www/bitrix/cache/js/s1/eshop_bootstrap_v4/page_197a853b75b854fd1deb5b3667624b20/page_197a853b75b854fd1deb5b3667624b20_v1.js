
; /* Start:"a:4:{s:4:"full";s:89:"/bitrix/components/bitrix/learning.course.tree/templates/.default/script.js?1791969504690";s:6:"source";s:75:"/bitrix/components/bitrix/learning.course.tree/templates/.default/script.js";s:3:"min";s:0:"";s:3:"map";s:0:"";}"*/
function JCMenu(sOpenedSections, COURSE_ID)
{
	this.oSections = {};
	this.COURSE_ID = COURSE_ID;

	var aSect = sOpenedSections.split(',');
	for(var i in aSect)
		this.oSections[aSect[i]] = true;

	this.OpenChapter = function(oThis, id)
	{
		if (oThis.parentNode.className == '')
		{
			this.oSections[id] = false;
			oThis.parentNode.className = 'close';
		}
		else
		{
			this.oSections[id] = true;
			oThis.parentNode.className = '';
		}

		var sect='';
		for(var i in this.oSections)
		if(this.oSections[i] == true)
			sect += (sect != ''? ',':'')+i;
		document.cookie = "LEARN_MENU_"+this.COURSE_ID+"=" + sect + "; expires=Thu, 31 Dec 2020 23:59:59 GMT; path=/;";

		return false;
	}

}
/* End */
;
; /* Start:"a:4:{s:4:"full";s:83:"/bitrix/components/bitrix/learning.test/templates/.default/script.js?17919695041704";s:6:"source";s:68:"/bitrix/components/bitrix/learning.test/templates/.default/script.js";s:3:"min";s:0:"";s:3:"map";s:0:"";}"*/
function checkForEmpty(warnMessage)
{
	var answers = document.getElementsByName('answer[]');
	if(!answers || answers.length==0)
		answers = document.getElementsByName('answer');
	if(!answers || answers.length==0)
		return true;
	var exAnswers = [];
	for(var i=0;i<answers.length;i++)
	{
		if (answers[i].type == "textarea")
		{
			if (answers[i].value.length > 0)
				return true;
		}
		else
		{
			if(answers[i].selected || answers[i].checked)
				return true;
		}
	}
	return confirm(warnMessage);
}

function checkSorting(warnMessage)
{
	var answers = document.getElementsByName('answer[]');
	if(!answers || answers.length==0)
		return true;
	var exAnswers = [];
	for(var i=0;i<answers.length;i++)
	{
		if (answers[i].value == 0)
			return confirm(warnMessage);
		else
		{
			for(var j=0; j<exAnswers.length;j++)
			{
				if (answers[i].value == exAnswers[j])
					return confirm(warnMessage);
			}
			exAnswers.push(answers[i].value);
		}
	}
	return true;
}

function UpdateClock(seconds)
{
	if(clockID)
		clearTimeout(clockID);

	if (!(seconds >= 0))
		return;

	var SecondsToEnd = seconds;

	var strTime = "";
	var hours = Math.floor(seconds/3600);

	if (hours > 0)
	{
		strTime += (hours < 10 ? "0" : "") + hours + ":";
		seconds = seconds - hours*3600;
	}
	else
	{
		strTime += "00:";
	}

	var minutes = Math.floor(seconds/60);

	if (minutes > 0)
	{
		strTime += (minutes < 10 ? "0" : "") + minutes + ":";
		seconds = seconds - minutes*60;
	}
	else
	{
		strTime += "00:";
	}
	
	var sec = (seconds%60);
	strTime += (sec < 10 ? "0" : "") + sec;

	//alert(strTime);

	document.getElementById("learn-test-timer").innerHTML = strTime;

	clockID = setTimeout("UpdateClock("+(SecondsToEnd-1)+")", 950);
}
/* End */
;; /* /bitrix/components/bitrix/learning.course.tree/templates/.default/script.js?1791969504690*/
; /* /bitrix/components/bitrix/learning.test/templates/.default/script.js?17919695041704*/
