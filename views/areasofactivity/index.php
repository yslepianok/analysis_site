<script type="text/javascript" src="../js/areasofactivityController.js"></script>
<div  ng-app="areasofactivityApp">
	<div ng-controller="areasofactivityController">
		<div>
			<h1 class="z1">Сферы деятельности:</h1>
		</div>
    <div ng-if="flag!=1" ng-click="getInformation()" style="border-left : 5px solid grey;
      border-top : 5px solid grey; width: 30%; background-color: darkgrey;
      color : white;">
      Нажмите, что бы получить информацию о рекомендуемых сферах деятельности!
    </div>
      <table border="1px" style="width : 45%; font-size: 18px;" ng-if="flag==1">
        <tr>
          <td style="padding-left : 5px; padding-top : 2px;">Название</td>
          <td style="padding-left : 5px; padding-top : 2px;">Вес</td>
        </tr>
        <tr ng-repeat="res in Data">
          <td ng-if="$index<4" style="background-color : lightgreen; padding-left : 5px; padding-top : 2px;">{{res.name}}</td>
          <td ng-if="$index<4" style="background-color : lightgreen; padding-left : 5px; padding-top : 2px;">{{result.matrix['1.'+($index+1)]}}</td>
          <td ng-if="$index>3 && $index<14" style="padding-left : 5px;">{{res.name}}</td>
          <td ng-if="$index>3 && $index<14" style="padding-left : 5px;">{{result.matrix['1.'+($index+1)]}}</td>
          <td ng-if="$index>13" style="background-color : lightcoral; padding-left : 5px; padding-top : 2px;">{{res.name}}</td>
          <td ng-if="$index>13" style="background-color : lightcoral; padding-left : 5px; padding-top : 2px;">{{result.matrix['1.'+($index+1)]}}</td>
        </tr>
      </table>
  </div>
</div>
