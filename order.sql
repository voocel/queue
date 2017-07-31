CREATE TABLE `order_queue`(
    `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'id号',
    `order_id` int(11) NOT NULL,
    `mobile` varchar(20) NOT NULL COMMENT '用户手机',
    `created_at` datetime NOT NULL DEFAULT NOW() COMMENT'订单创建时间',
    `updated_at` datetime NOT NULL DEFAULT NOW() COMMENT'处理完成时间',
    `status` tinyint(2) NOT NULL COMMENT '当前状态，0未处理，1已处理，2处理中',
    PRIMARY KEY(`id`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;