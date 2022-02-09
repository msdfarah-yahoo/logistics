/ example/
-- CREATE table `advertises` (
--     `sellerid` int(5) UNSIGNED,
--     foreign key (sellerid) references sellers(sellerid)
-- ) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE table `users` (
    `userid` int(2) UNSIGNED PRIMARY key AUTO_INCREMENT,
    `username` VARCHAR(80) DEFAULT '',
    `password` VARCHAR(30)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE or replace TABLE `models`(
    `siteid` INT(2) UNSIGNED,
    `modelid` INT(2) UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    `model` VARCHAR(50) DEFAULT ''
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `sites`(
    `siteid` INT(2) UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    `site` VARCHAR(50) DEFAULT ''
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

create or replace table `line`
(
    `siteid` INT(2) unsigned,
    `lineid` int(2) UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    `line` varchar(50)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

create table `items`
(
    `modelid` INT(2) UNSIGNED,
    `itemcode` int(3) primary key AUTO_INCREMENT,
    `item` varchar(50)
);

CREATE table `cars` (
    `carid` int(2) UNSIGNED PRIMARY key AUTO_INCREMENT,
    `description` VARCHAR(50) DEFAULT '',
    `carno` VARCHAR(15)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE table `drivers` (
    `driverid` int(2) UNSIGNED PRIMARY key AUTO_INCREMENT,
    `dname` VARCHAR(80) DEFAULT '',
    `carid` int(2)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

create or replace table plan
(
    `pdate` date,
    `siteid` int(2),
    `lineid` int(2),
    `po` varchar(15) ,
    `wo` varchar(15),
    `modelid` int(2),
    `itemcode` int(6),
    `pqty` int(3)
);

create or replace table dispatch
(
    `ddate` date,
    `siteid` int(2),
    `lineid` int(2),
    `po` varchar(15),
    `wo` varchar(15),
    `modelid` int(2),
    `itemcode` int(6),
    `dqty` int(3)
);

create or replace table trans
(
    `tdate` date,
    `siteid` int(2),
    `lineid` int(2),
    `po` varchar(15),
    `wo` varchar(15),
    `modelid` int(2),
    `itemcode` int(6),
    `tqty` int(3),
    `dn` varchar(15),
    `driverid` int(2),
    `trip` int(2),
    `notices` varchar(50)
);

/****************** Queries ********************/
create or replace view qry_plan
as
(select 
    plan.pdate,
    sites.site,
    line.line,
	plan.wo,
	plan.po,
	models.model,
    plan.itemcode,
	items.item,  
    plan.pqty
   	from 
    plan,items,sites,line,models
	where
    plan.siteid=sites.siteid and
    plan.lineid=line.lineid and
    plan.itemcode=items.itemcode and
    plan.modelid=items.modelid
);

create or replace view qry_dispatch
as
(select 
    dispatch.ddate,
    sites.site,
    line.line,
	dispatch.wo,
	dispatch.po,
    models.model,
	dispatch.itemcode,
	items.item,
    dispatch.dqty
   	from 
    dispatch,items,sites,line,models
	where
    dispatch.siteid=sites.siteid and
    dispatch.lineid=line.lineid and
    dispatch.itemcode=items.itemcode and
    dispatch.modelid=models.modelid
);

create or replace view qry_trans
as
(select 
    trans.tdate,
    sites.site,
    line.line,
	trans.wo,
	trans.po,
    models.model,
	trans.itemcode,
	items.item,
    trans.tqty,
    trans.dn,
    drivers.dname,
    trans.trip,
    trans.notices
	from 
    trans,items,sites,line,drivers,models
	where
    trans.siteid=sites.siteid and
    trans.lineid=line.lineid and
    trans.itemcode=items.itemcode and
    trans.driverid=drivers.driverid and
    trans.modelid=models.modelid 
);

create or replace view qry_subscriptions
as
(select subscriptions.sname,
	subscriptions.phone,
	subscriptions.email,
	subs_types.subscription,
	subscriptions.sdate,
	serv_types.service,
	serv_types.amount,
	pay_types.pay,
	subscriptions.subs_no
	
	from subscriptions,subs_types,serv_types,pay_types
	where subscriptions.subs_type =subs_types.sno and
	      subscriptions.serv_type =serv_types.sno and 
	      subscriptions.pay_type  =pay_types.pno       
);
/***** formulas ******************/

create or replace view qry_sum_dispatch
as
(select 
qry_dispatch.ddate,
qry_dispatch.site,
qry_dispatch.line,
   	qry_dispatch.wo,
	qry_dispatch.po,
	qry_dispatch.itemcode,
    qry_dispatch.item,
	sum(qry_dispatch.dqty) as dqty
   	from 
    qry_dispatch
	group by
    qry_dispatch.wo,qry_dispatch.po,qry_dispatch.itemcode 
);
create or replace view qry_sum_dispatch_items
as
(select 
   	qry_sum_dispatch.wo,
	qry_sum_dispatch.po,
	qry_sum_dispatch.itemcode,
    items.item,
	qry_sum_dispatch.dqty
   	from 
    qry_sum_dispatch,items
	where
    qry_sum_dispatch.itemcode=items.itemcode 
);

create or replace view qry_sum_trans
as
(select
qry_trans.tdate,
qry_trans.site,
qry_trans.line, 
   	qry_trans.wo,
	qry_trans.po,
	qry_trans.itemcode,
    qry_trans.item,
	sum(qry_trans.tqty) as tqty
   	from 
    qry_trans
	group by
    qry_trans.wo,qry_trans.po,qry_trans.itemcode 
);
create or replace view qry_sum_trans_items
as
(select
   	qry_sum_trans.wo,
	qry_sum_trans.po,
	qry_sum_trans.itemcode,
    items.item,
	qry_sum_trans.tqty
   	from 
    qry_sum_trans,items
	where
    qry_sum_trans.itemcode=items.itemcode 
);
create or replace view qry_dispatch_balance
as
(select 
  qry_sum_dispatch.ddate,
  qry_sum_dispatch.site,
  qry_sum_dispatch.line,
   	qry_sum_dispatch.wo,
	qry_sum_dispatch.po,
	qry_sum_dispatch.itemcode,
    qry_sum_dispatch.item,
    qry_sum_dispatch.dqty,
    qry_sum_trans.tqty,
	qry_sum_dispatch.dqty-qry_sum_trans.tqty as dbalance
   	from 
    qry_sum_dispatch,qry_sum_trans
	where
    qry_sum_dispatch.itemcode=qry_sum_trans.itemcode 
);

create or replace view qry_dispatch_balance_items
as
(select 
   	qry_dispatch_balance.wo,
	qry_dispatch_balance.po,
	qry_dispatch_balance.itemcode,
    items.item,
    qry_dispatch_balance.dqty,
    qry_dispatch_balance.tqty,
	qry_dispatch_balance.dbalance
   	from 
    qry_dispatch_balance,items
	where
    qry_dispatch_balance.itemcode=items.itemcode 
);


create or replace view qry_plan_balance
as
(select 
    qry_plan.pdate,
    qry_plan.site,
    qry_plan.line,
	qry_plan.wo,
	qry_plan.po,
	qry_plan.model,
    qry_plan.itemcode,
	qry_plan.item,
    qry_plan.pqty,
    qry_sum_dispatch.dqty,
    qry_plan.pqty-qry_sum_dispatch.dqty as pbal
    from 
    qry_plan,qry_sum_dispatch
	where
    qry_plan.wo=qry_sum_dispatch.wo and
    qry_plan.po=qry_sum_dispatch.po and
    qry_plan.itemcode=qry_sum_dispatch.itemcode 
);

