USE [SBL]
GO
/****** Object:  StoredProcedure [dbo].[ConsultaSelectpartId]    Script Date: 22/03/2021 09:03:13 a. m. ******/
DROP PROCEDURE [dbo].[ConsultaSelectpartId]
GO
/****** Object:  StoredProcedure [dbo].[ConsultaSelectlotId]    Script Date: 22/03/2021 09:03:13 a. m. ******/
DROP PROCEDURE [dbo].[ConsultaSelectlotId]
GO
/****** Object:  StoredProcedure [dbo].[ConsultaSelectidShift]    Script Date: 22/03/2021 09:03:13 a. m. ******/
DROP PROCEDURE [dbo].[ConsultaSelectidShift]
GO
/****** Object:  StoredProcedure [dbo].[ConsultaOEETrendsGrid]    Script Date: 22/03/2021 09:03:13 a. m. ******/
DROP PROCEDURE [dbo].[ConsultaOEETrendsGrid]
GO
/****** Object:  StoredProcedure [dbo].[ConsultaOEETrends]    Script Date: 22/03/2021 09:03:13 a. m. ******/
DROP PROCEDURE [dbo].[ConsultaOEETrends]
GO
/****** Object:  StoredProcedure [dbo].[ConsultaOEEDoughnut]    Script Date: 22/03/2021 09:03:13 a. m. ******/
DROP PROCEDURE [dbo].[ConsultaOEEDoughnut]
GO
/****** Object:  StoredProcedure [dbo].[ConsultaOEEComponentes]    Script Date: 22/03/2021 09:03:13 a. m. ******/
DROP PROCEDURE [dbo].[ConsultaOEEComponentes]
GO
/****** Object:  StoredProcedure [dbo].[ConsultaMonitoreovar]    Script Date: 22/03/2021 09:03:13 a. m. ******/
DROP PROCEDURE [dbo].[ConsultaMonitoreovar]
GO
/****** Object:  StoredProcedure [dbo].[ConsultaMonitoreovar]    Script Date: 22/03/2021 09:03:13 a. m. ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

CREATE PROCEDURE [dbo].[ConsultaMonitoreovar]
@_inpdate varchar(16)

as



select idvariable,variables.name, machines.name as machine, value, lowLimit
                from trends
                 inner join variables on variables.id = trends.idvariable
                 inner join machines on variables.idmachine = machines.id
                where    convert(varchar(20),convert(date,date)) + ' ' + 
						substring( convert(varchar(100),date,108),1,5)
				= @_inpdate and value < lowLimit
 union               
 select idvariable,variables.name, machines.name as machine, value, highLimit
                from trends
                 inner join variables on variables.id = trends.idvariable
                 inner join machines on variables.idmachine = machines.id
                where convert(varchar(20),convert(date,date)) + ' ' + 
						substring( convert(varchar(100),date,108),1,5) = @_inpdate and value > highLimit;


GO
/****** Object:  StoredProcedure [dbo].[ConsultaOEEComponentes]    Script Date: 22/03/2021 09:03:13 a. m. ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO


CREATE PROCEDURE [dbo].[ConsultaOEEComponentes] 
		@_caso VARCHAR(1), 
		@_machId INT, 
		@_inpdate varchar(10), 
		@_casoS VARCHAR(1), 
		@_partId VARCHAR(45), 
		@_lotId VARCHAR(45), 
		@_idShift INT
    as

	Declare @fecha date
	select @fecha=convert(date,@_inpdate)
	
	IF (@_caso = 'd') 
			BEGIN
					IF @_casoS='1'
							BEGIN
									--General, solo por maquina
								select 
									min(CONVERT(DATE,capturedTime)) as date,  
									cast( sum(goodParts)as decimal(10,2)) GoodParts,
									cast( sum(totalPieces)as decimal(10,2)) TotalParts,
									cast( sum(totalPieces) - sum(GoodParts) as decimal(10,2)) BadParts,
									cast( sum(runTime) as decimal(10,2)) RunningTime,
									cast( sum(availableTime) as decimal(10,2)) AvailableTime,
									cast( avg(ICT) as decimal(10,2)) ICT
								from oee where CONVERT(date,capturedTime) =  convert(date,@_inpdate)  					
								and idmachine = @_machId 
								END
						ELSE IF @_casoS='2'
							BEGIN
								--Por maquina y PartID
								select 
									min(CONVERT(DATE,capturedTime)) as date,  
									cast( sum(goodParts)as decimal(10,2)) GoodParts,
									cast( sum(totalPieces)as decimal(10,2)) TotalParts,
									cast( sum(totalPieces) - sum(GoodParts) as decimal(10,2)) BadParts,
									cast( sum(runTime) as decimal(10,2)) RunningTime,
									cast( sum(availableTime) as decimal(10,2)) AvailableTime,
									cast( avg(ICT) as decimal(10,2)) ICT
								from oee where CONVERT(date,capturedTime) =  convert(date,@_inpdate)  					
								AND idmachine = @_machId  AND partId=@_partId
								END

						ELSE IF @_casoS='3'
							BEGIN
								-- Por maquina y  lote
								select 
									min(CONVERT(DATE,capturedTime)) as date,  
									cast( sum(goodParts)as decimal(10,2)) GoodParts,
									cast( sum(totalPieces)as decimal(10,2)) TotalParts,
									cast( sum(totalPieces) - sum(GoodParts) as decimal(10,2)) BadParts,
									cast( sum(runTime) as decimal(10,2)) RunningTime,
									cast( sum(availableTime) as decimal(10,2)) AvailableTime,
									cast( avg(ICT) as decimal(10,2)) ICT
								from oee where CONVERT(date,capturedTime) =  convert(date,@_inpdate)  
					
								and idmachine = @_machId  and  idShift=  @_idShift AND lotId=@_lotId
								END
						ELSE IF @_casoS='3'
							BEGIN
								-- Por maquina y  turno
								select 
									min(CONVERT(DATE,capturedTime)) as date,  
									cast( sum(goodParts)as decimal(10,2)) GoodParts,
									cast( sum(totalPieces)as decimal(10,2)) TotalParts,
									cast( sum(totalPieces) - sum(GoodParts) as decimal(10,2)) BadParts,
									cast( sum(runTime) as decimal(10,2)) RunningTime,
									cast( sum(availableTime) as decimal(10,2)) AvailableTime,
									cast( avg(ICT) as decimal(10,2)) ICT
								from oee where CONVERT(date,capturedTime) =  convert(date,@_inpdate)  
					
								and idmachine = @_machId  and  idShift=  @_idShift 
								END


		
	END		-- ENDIF OF @_caso_'d'

	ELSE	IF (@_caso = 'm') 
			BEGIN
					IF @_casoS='1'
							BEGIN
									--General, solo por maquina
								select 
									min(CONVERT(DATE,capturedTime)) as date,  
									cast( sum(goodParts)as decimal(10,2)) GoodParts,
									cast( sum(totalPieces)as decimal(10,2)) TotalParts,
									cast( sum(totalPieces) - sum(GoodParts) as decimal(10,2)) BadParts,
									cast( sum(runTime) as decimal(10,2)) RunningTime,
									cast( sum(availableTime) as decimal(10,2)) AvailableTime,
									cast( avg(ICT) as decimal(10,2)) ICT
									from oee 
									where month (capturedTime) =  month(@fecha) 
									and year (capturedTime) =  year(@fecha)
								and idmachine = @_machId 
								 --Tomado de  ---------
								--SELECT FORMAT(GETDATE(),'yyyy-MM') as fecha;
								---------------------
								
								END
						ELSE IF @_casoS='2'
							BEGIN
								--Por maquina y PartID
								select 
									min(CONVERT(DATE,capturedTime)) as date,  
									cast( sum(goodParts)as decimal(10,2)) GoodParts,
									cast( sum(totalPieces)as decimal(10,2)) TotalParts,
									cast( sum(totalPieces) - sum(GoodParts) as decimal(10,2)) BadParts,
									cast( sum(runTime) as decimal(10,2)) RunningTime,
									cast( sum(availableTime) as decimal(10,2)) AvailableTime,
									cast( avg(ICT) as decimal(10,2)) ICT
									from oee 
									where month (capturedTime) =  month(@fecha) 
									and year (capturedTime) =  year(@fecha)
								AND idmachine = @_machId  AND partId=@_partId
								END

						ELSE IF @_casoS='3'
							BEGIN
								-- Por maquina y  lote
								select 
									min(CONVERT(DATE,capturedTime)) as date,  
									cast( sum(goodParts)as decimal(10,2)) GoodParts,
									cast( sum(totalPieces)as decimal(10,2)) TotalParts,
									cast( sum(totalPieces) - sum(GoodParts) as decimal(10,2)) BadParts,
									cast( sum(runTime) as decimal(10,2)) RunningTime,
									cast( sum(availableTime) as decimal(10,2)) AvailableTime,
									cast( avg(ICT) as decimal(10,2)) ICT
									from oee 
									
									where month (capturedTime) =  month(@fecha) 
									and year (capturedTime) =  year(@fecha)  											
								and idmachine = @_machId  and  idShift=  @_idShift AND lotId=@_lotId
								END
						ELSE IF @_casoS='3'
							BEGIN
								-- Por maquina y  turno
								select 
									min(CONVERT(DATE,capturedTime)) as date,  
									cast( sum(goodParts)as decimal(10,2)) GoodParts,
									cast( sum(totalPieces)as decimal(10,2)) TotalParts,
									cast( sum(totalPieces) - sum(GoodParts) as decimal(10,2)) BadParts,
									cast( sum(runTime) as decimal(10,2)) RunningTime,
									cast( sum(availableTime) as decimal(10,2)) AvailableTime,
									cast( avg(ICT) as decimal(10,2)) ICT
								from oee where
								month (capturedTime) =  month(@fecha) 
									and year (capturedTime) =  year(@fecha) 										
								and idmachine = @_machId  and  idShift=  @_idShift 
								END


		
	END



		
		

GO
/****** Object:  StoredProcedure [dbo].[ConsultaOEEDoughnut]    Script Date: 22/03/2021 09:03:13 a. m. ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO


CREATE PROCEDURE [dbo].[ConsultaOEEDoughnut]

		@_caso VARCHAR(1), 
		@_machId INT, 
		@_inpdate varchar(10), 		
		@_casoS varchar(1),
		@_partId VARCHAR(45), 
		@_lotId VARCHAR(45), 
		@_idShift INT

			--- EXECUTE ConsultaOEEDoughnut 'd',1,'2020-07-19',1,1,1,1
as

		DECLARE @SRuntime decimal(10,2)
		DECLARE @SavailableTime decimal(10,2)
		DECLARE @StotalPieces int
		Declare @SgoodParts int
		DECLARE @fecha date
		DECLARE @AVGICT int								 -- El promedio del tiempo ciclo ideal, si cambia se realizara el promedio 
		
							DECLARE @AvailabilityG	DECIMAL(10,2)
							DECLARE @AvailabilityR	DECIMAL(10,2)
							DECLARE @performanceG	DECIMAL(10,2)
							DECLARE @performanceR	DECIMAL(10,2)
							DECLARE @qualityG		DECIMAL(10,2)
							DECLARE @qualityR		DECIMAL(10,2)							
							DECLARE @OEEG			decimal(10,2)
							DECLARE @OEER			decimal(10,2)





				if (@_caso='m')
			begin
				select @fecha=CONCAT( @_inpdate,'-01')
	 
			end
			else if (@_caso='d')
			begin
				select @fecha=CONVERT(date,@_inpdate)
			end
	
	   	  

							



  
    --BEGIN TRY  
		IF (@_caso = 'd')
		
		Begin
				if(@_casoS=1)

                BEGIN
                        /*Segundo retornamos los promedios de ese dia*/

						SELECT  					                            
							@SRuntime=  		convert(decimal(10,2), avg(runTime)),
							@AvailabilityG=		convert(decimal(10,2), avg(availability) ) ,							
							@performanceG=		convert(decimal(10,2), avg(performance)),
							@qualityG=			convert(decimal(10,2),avg(quality)),
							@OEEG=				convert(decimal(10,2), avg(oee))
							from oee  where convert(date,capturedTime)=@fecha and idmachine=@_machId 
							
				end						

					if(@_casoS=2)

                BEGIN
                        /*Segundo retornamos los promedios de ese dia*/

						SELECT  					                            
							@SRuntime=  		convert(decimal(10,2), avg(runTime)) ,
							@AvailabilityG=		convert(decimal(10,2), avg(availability) ) ,							
							@performanceG=		convert(decimal(10,2), avg(performance)),
							@qualityG=			convert(decimal(10,2),avg(quality)),
							@OEEG=				convert(decimal(10,2), avg(oee))
							from oee  where convert(date,capturedTime)=@fecha and idmachine=@_machId  and partId=@_partId
							
				end				
				
				if(@_casoS=3)

                BEGIN
                        /*Segundo retornamos los promedios de ese dia*/

						SELECT  					                            
							@SRuntime=  		convert(decimal(10,2), avg(runTime)) ,
							@AvailabilityG=		convert(decimal(10,2), avg(availability) ) ,							
							@performanceG=		convert(decimal(10,2), avg(performance)),
							@qualityG=			convert(decimal(10,2),avg(quality)),
							@OEEG=				convert(decimal(10,2), avg(oee))
							from oee  where convert(date,capturedTime)=@fecha and idmachine=@_machId  and lotId=@_lotId
							
				end			
				

				if(@_casoS=4)

                BEGIN
                        /*Segundo retornamos los promedios de ese dia*/

						SELECT  					                            
							@SRuntime=  		convert(decimal(10,2), avg(runTime)) ,
							@AvailabilityG=		convert(decimal(10,2), avg(availability) ) ,							
							@performanceG=		convert(decimal(10,2), avg(performance)),
							@qualityG=			convert(decimal(10,2),avg(quality)),
							@OEEG=				convert(decimal(10,2), avg(oee))
							from oee  where convert(date,capturedTime)=@fecha and idmachine=@_machId  and idShift=@_idShift
							
				end			
	
						

						

		End


		IF (@_caso = 'm')
		
		Begin
				if(@_casoS=1)

                BEGIN
                        /*Segundo retornamos los promedios de ese dia*/

						SELECT  					                            
							@SRuntime=  		convert(decimal(10,2), avg(runTime)) ,
							@AvailabilityG=		convert(decimal(10,2), avg(availability) ) ,							
							@performanceG=		convert(decimal(10,2), avg(performance)),
							@qualityG=			convert(decimal(10,2),avg(quality)),
							@OEEG=				convert(decimal(10,2), avg(oee))
							from oee  where  month(capturedTime)=month(@fecha) and year(capturedTime)=year(@fecha) and idmachine=@_machId 
							
				end						

					if(@_casoS=2)

                BEGIN
                        /*Segundo retornamos los promedios de ese dia*/

						SELECT  					                            
							@SRuntime=  		convert(decimal(10,2), avg(runTime)) ,
							@AvailabilityG=		convert(decimal(10,2), avg(availability) ) ,							
							@performanceG=		convert(decimal(10,2), avg(performance)),
							@qualityG=			convert(decimal(10,2),avg(quality)),
							@OEEG=				convert(decimal(10,2), avg(oee))
							from oee  where  month(capturedTime)=month(@fecha) and year(capturedTime)=year(@fecha) and idmachine=@_machId  and partId=@_partId
							
				end				
				
				if(@_casoS=3)

                BEGIN
                        /*Segundo retornamos los promedios de ese dia*/

						SELECT  					                            
							@SRuntime=  		convert(decimal(10,2), avg(runTime)) ,
							@AvailabilityG=		convert(decimal(10,2), avg(availability) ) ,							
							@performanceG=		convert(decimal(10,2), avg(performance)),
							@qualityG=			convert(decimal(10,2),avg(quality)),
							@OEEG=				convert(decimal(10,2), avg(oee))
							from oee  where  month(capturedTime)=month(@fecha) and year(capturedTime)=year(@fecha) and idmachine=@_machId  and lotId=@_lotId
							
				end			
				

				if(@_casoS=4)

                BEGIN
                        /*Segundo retornamos los promedios de ese dia*/

						SELECT  					                            
							@SRuntime=  		convert(decimal(10,2), avg(runTime)) ,
							@AvailabilityG=		convert(decimal(10,2), avg(availability) ) ,							
							@performanceG=		convert(decimal(10,2), avg(performance)),
							@qualityG=			convert(decimal(10,2),avg(quality)),
							@OEEG=				convert(decimal(10,2), avg(oee))
							from oee  where  month(capturedTime)=month(@fecha) and year(capturedTime)=year(@fecha) and idmachine=@_machId  and idShift=@_idShift
							
				end			
	
						

						

		End








		SELECT 
                            date=@fecha ,
							AvailabilityG=convert(decimal(10,2),@AvailabilityG),
							AvailabilityR=100-convert(decimal(10,2),@AvailabilityG),
							performanceG=convert(decimal(10,2),@performanceG),
							performanceR=100-convert(decimal(10,2),@performanceG),
							qualityG=@qualityG	,
							qualityR=100 -  @qualityG	,
							OEEG=@OEEG,
							OEER=100-@OEEG

						




	
GO
/****** Object:  StoredProcedure [dbo].[ConsultaOEETrends]    Script Date: 22/03/2021 09:03:13 a. m. ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

CREATE PROCEDURE [dbo].[ConsultaOEETrends]
@_caso VARCHAR(1),
@_machId INT,
@_inpdate varchar(10),
@_casoS varchar(1),
@_partId varchar(45),
@_lotId varchar(45),
@_idShit int
as

declare @fechaDate date
select @fechaDate=convert(date, GETDATE())

if (@_caso='m')
begin
select @fechaDate=CONCAT( @_inpdate,'-01')
end
else if (@_caso='d')
begin
select @fechaDate=CONVERT(date,@_inpdate)
end

/*
_casoS
1 Solo se selecciona todos.
2 Por partId
3 por LoteID
*/

If @_caso = 'd'
Begin
If (@_casoS='1')
Begin

 Select date=convert(varchar(2), DATEPART(HH,capturedTime)) + ':' + convert(varchar(2), DATEPART(mi,capturedTime)),
availability,performance, quality,oee
from oee
where convert(date,capturedTime) =@fechaDate and idmachine = @_machId
order by capturedTime asc;

 End
Else If (@_casoS='2')
Begin

 Select date=convert(varchar(2), DATEPART(HH,capturedTime)) + ':' + convert(varchar(2), DATEPART(mi,capturedTime)),
availability,performance, quality,oee
from oee
where convert(date,capturedTime) =@fechaDate and idmachine = @_machId and partId=@_partId
order by capturedTime asc;

 End

 Else If (@_casoS='3')
Begin
Select date=convert(varchar(2), DATEPART(HH,capturedTime)) + ':' + convert(varchar(2), DATEPART(mi,capturedTime)),
availability,performance, quality,oee
from oee
where convert(date,capturedTime) =@fechaDate and idmachine = @_machId and lotId=@_lotId
order by capturedTime asc;
End
Else If (@_casoS='4')
Begin
Select date=convert(varchar(2), DATEPART(HH,capturedTime)) + ':' + convert(varchar(2), DATEPART(mi,capturedTime)),
availability,performance, quality,oee
from oee
where convert(date,capturedTime) =@fechaDate and idmachine = @_machId and idShift=@_idShit
order by capturedTime asc;
End
End
Else If @_caso = 'm'
Begin
If (@_casoS='1')
Begin

 Select date=convert(varchar(2), DATEPART(dd,capturedTime)) + '/' + convert(varchar(2), DATEPART(MM,capturedTime)),
avg(availability),avg(performance), avg(quality),avg(oee)
from oee
where
month (capturedTime) = month(@fechaDate)
and year (capturedTime) = year(@fechaDate)
and idmachine = @_machId
group by capturedTime
order by capturedTime

End
Else If (@_casoS='2')
Begin

 Select date=convert(varchar(2), DATEPART(dd,capturedTime)) + '/' + convert(varchar(2), DATEPART(MM,capturedTime)),
avg(availability),avg(performance), avg(quality),avg(oee)
from oee
where month (capturedTime) = month(@fechaDate)
and year (capturedTime) = year(@fechaDate)
and idmachine = @_machId and partId=@_partId
group by capturedTime
order by capturedTime

 End

 Else If (@_casoS='3')
Begin
Select date=convert(varchar(2), DATEPART(dd,capturedTime)) + '/' + convert(varchar(2), DATEPART(MM,capturedTime)),
avg(availability),avg(performance), avg(quality),avg(oee)
from oee
where
month (capturedTime) = month(@fechaDate)
and year (capturedTime) = year(@fechaDate)
and idmachine = @_machId and lotId=@_lotId
group by capturedTime
order by capturedTime
End
Else If (@_casoS='4')
Begin
Select date=convert(varchar(2), DATEPART(dd,capturedTime)) + '/' + convert(varchar(2), DATEPART(MM,capturedTime)),
avg(availability),avg(performance), avg(quality),avg(oee)
from oee
where
month (capturedTime) = month(@fechaDate)
and year (capturedTime) = year(@fechaDate)
and idmachine = @_machId and idShift=@_idShit
group by capturedTime
order by capturedTime
End
End


GO
/****** Object:  StoredProcedure [dbo].[ConsultaOEETrendsGrid]    Script Date: 22/03/2021 09:03:13 a. m. ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE PROCEDURE [dbo].[ConsultaOEETrendsGrid]
@_caso VARCHAR(1),
@_groupId INT,
@_machId INT,
@_inpdate VARCHAR(10), ---FECHA EN FORMATO SENCILLO
@_casoS VARCHAR(1),
@_partId VARCHAR(45),
@_lotId VARCHAR(45),
@_idShift INT

AS

Declare @fecha date
if (@_caso='m')
begin
select @fecha=CONCAT( @_inpdate,'-01')
end
else if (@_caso='d')
begin
select @fecha=CONVERT(date,@_inpdate)
end


 IF @_caso = 'd'
BEGIN
IF @_casoS='1'
BEGIN
select
date=convert(varchar(100), convert(date,capturedTime)) + ' ' + convert(varchar(5), convert(time, capturedTime)),
oee=convert(decimal(10,2),oee),
availability=convert(decimal(10,2),availability),
runTime,
availableTime,
performance=convert(decimal(10,2),performance),
ict=convert(decimal(10,2),ict),
totalPieces,
quality,
goodParts,
lotId,
partId,
idShift,
shifts.name as turno
from oee
inner join shifts on shifts.id = oee.idShift
where convert (date,capturedTime)=@fecha and shifts.idgroup = @_groupId and idmachine = @_machId
order by capturedTime desc

 END

ELSE IF @_casoS='2'
BEGIN
select
date=convert(varchar(100), convert(date,capturedTime)) + ' ' + convert(varchar(5), convert(time, capturedTime)),
oee=convert(decimal(10,2),oee),
availability=convert(decimal(10,2),availability),
runTime,
availableTime,
performance=convert(decimal(10,2),performance),
ict=convert(decimal(10,2),ict),
totalPieces,
quality,
goodParts,
lotId,
partId,
idShift,
shifts.name as turno
from oee
inner join shifts on shifts.id = oee.idShift
where convert (date,capturedTime)=@fecha and shifts.idgroup = @_groupId and idmachine = @_machId AND partId=@_partId
order by capturedTime desc

 END

ELSE IF @_casoS='3'
BEGIN
select
date=convert(varchar(100), convert(date,capturedTime)) + ' ' + convert(varchar(5), convert(time, capturedTime)),
oee=convert(decimal(10,2),oee),
availability=convert(decimal(10,2),availability),
runTime,
availableTime,
performance=convert(decimal(10,2),performance),
ict=convert(decimal(10,2),ict),
totalPieces,
quality,
goodParts,
lotId,
partId,
idShift,
shifts.name as turno
from oee
inner join shifts on shifts.id = oee.idShift
where convert (date,capturedTime)=@fecha and shifts.idgroup = @_groupId and idmachine = @_machId AND lotId=@_lotId
order by capturedTime desc

 END

END
IF @_caso = 'm'
BEGIN
IF @_casoS='1'
BEGIN
select
date=convert(varchar(100), convert(date,capturedTime)) + ' ' + convert(varchar(5), convert(time, capturedTime)),
oee=convert(decimal(10,2),oee),
availability=convert(decimal(10,2),availability),
runTime,
availableTime,
performance=convert(decimal(10,2),performance),
ict=convert(decimal(10,2),ict),
totalPieces,
quality,
goodParts,
lotId,
partId,
idShift,
shifts.name as turno
from oee
inner join shifts on shifts.id = oee.idShift
where month (capturedTime) = month(@fecha)
and year (capturedTime) = year(@fecha)
and shifts.idgroup = @_groupId and idmachine = @_machId
order by capturedTime desc

 END

ELSE IF @_casoS='2'
BEGIN
select
date=convert(varchar(100), convert(date,capturedTime)) + ' ' + convert(varchar(5), convert(time, capturedTime)),
oee=convert(decimal(10,2),oee),
availability=convert(decimal(10,2),availability),
runTime,
availableTime,
performance=convert(decimal(10,2),performance),
ict=convert(decimal(10,2),ict),
totalPieces,
quality,
goodParts,
lotId,
partId,
idShift,
shifts.name as turno
from oee
inner join shifts on shifts.id = oee.idShift
where month (capturedTime) = month(@fecha)
and year (capturedTime) = year(@fecha)
and shifts.idgroup = @_groupId and idmachine = @_machId AND partId=@_partId
order by capturedTime desc

 END

ELSE IF @_casoS='3'
BEGIN
select
date=convert(varchar(100), convert(date,capturedTime)) + ' ' + convert(varchar(5), convert(time, capturedTime)),
oee=convert(decimal(10,2),oee),
availability=convert(decimal(10,2),availability),
runTime,
availableTime,
performance=convert(decimal(10,2),performance),
ict=convert(decimal(10,2),ict),
totalPieces,
quality,
goodParts,
lotId,
partId,
idShift,
shifts.name as turno
from oee
inner join shifts on shifts.id = oee.idShift
where month (capturedTime) = month(@fecha)
and year (capturedTime) = year(@fecha)
and shifts.idgroup = @_groupId and idmachine = @_machId AND lotId=@_lotId
order by capturedTime desc

 END

END
GO
/****** Object:  StoredProcedure [dbo].[ConsultaSelectidShift]    Script Date: 22/03/2021 09:03:13 a. m. ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO



CREATE  PROCEDURE [dbo].[ConsultaSelectidShift]
@_caso VARCHAR(1), 
@_groupId INT, 
@_machId int, 
@_inpdate varchar(10) 
as

                    
					select idShift=id ,turno=name   					
					from shifts where idgroup=@_groupId
				


GO
/****** Object:  StoredProcedure [dbo].[ConsultaSelectlotId]    Script Date: 22/03/2021 09:03:13 a. m. ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO



CREATE  PROCEDURE [dbo].[ConsultaSelectlotId] @_caso VARCHAR(1), @_machId INT, @_inpdate varchar(10) 
    AS
IF @_caso = 'd' 

		BEGIN
				
                select 
                    lotId
                    from oee
                    where CONVERT(DATE,capturedTime ) = CONVERT (DATE,@_inpdate)
					and idmachine = @_machId
                    group by lotId
                    order by lotId asc;

		END
                            
ELSE IF @_caso='m' 
		BEGIN  
            
                select 
                    lotId
                    from oee
                    where 
					convert(date, capturedTime) =  convert(date,@_inpdate) 
					and
					 DATEPART(MONTH  , capturedTime) =  DATEPART(MONTH,@_inpdate)
					and idmachine = @_machId
                    group by lotId
                    order by lotId asc;
        
          END
GO
/****** Object:  StoredProcedure [dbo].[ConsultaSelectpartId]    Script Date: 22/03/2021 09:03:13 a. m. ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO




CREATE PROCEDURE [dbo].[ConsultaSelectpartId] 
	@_caso VARCHAR(1),
	@_machId INT, 
	@_inpdate varchar(10)
    
	AS
	IF @_caso = 'd' 

	BEGIN  
			

					select 
						partId
						from oee
						where 
						CONVERT(DATE,capturedTime)=@_inpdate
						and idmachine = @_machId
						group by  partId
						order by  partId asc;

	END
                            
	ELSE IF @_caso='m'
         BEGIN   
                		select 
						 partId
						from oee
						where  CONVERT(date,capturedTime ) = @_inpdate and idmachine = @_machId
						group by  partId
						order by  partId asc;
        
		END

	
GO
