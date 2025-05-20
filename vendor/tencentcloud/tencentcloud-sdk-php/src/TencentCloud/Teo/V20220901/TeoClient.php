<?php
/*
 * Copyright (c) 2017-2018 THL A29 Limited, a Tencent company. All Rights Reserved.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *    http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

namespace TencentCloud\Teo\V20220901;

use TencentCloud\Common\AbstractClient;
use TencentCloud\Common\Profile\ClientProfile;
use TencentCloud\Common\Credential;
use TencentCloud\Teo\V20220901\Models as Models;

/**
 * @method Models\BindSecurityTemplateToEntityResponse BindSecurityTemplateToEntity(Models\BindSecurityTemplateToEntityRequest $req) 操作安全策略模板，支持将域名绑定或换绑到指定的策略模板，或者从指定的策略模板解绑。
 * @method Models\BindSharedCNAMEResponse BindSharedCNAME(Models\BindSharedCNAMERequest $req) 用于加速域名绑定或解绑共享 CNAME，该功能白名单内测中。
 * @method Models\BindZoneToPlanResponse BindZoneToPlan(Models\BindZoneToPlanRequest $req) 将未绑定套餐的站点绑定到已有套餐
 * @method Models\CheckCnameStatusResponse CheckCnameStatus(Models\CheckCnameStatusRequest $req) 校验域名 CNAME 状态
 * @method Models\CreateAccelerationDomainResponse CreateAccelerationDomain(Models\CreateAccelerationDomainRequest $req) 在创建完站点之后，您可以通过本接口创建加速域名。 

CNAME 模式接入时，若您未完成站点归属权校验，本接口将为您返回域名归属权验证信息，您可以单独对域名进行归属权验证，详情参考 [站点/域名归属权验证](https://cloud.tencent.com/document/product/1552/70789)。
 * @method Models\CreateAliasDomainResponse CreateAliasDomain(Models\CreateAliasDomainRequest $req) 创建别称域名。
 * @method Models\CreateApplicationProxyResponse CreateApplicationProxy(Models\CreateApplicationProxyRequest $req) 本接口为旧版，如需调用请尽快迁移至新版 [创建四层代理实例](https://cloud.tencent.com/document/product/1552/103417) 。
 * @method Models\CreateApplicationProxyRuleResponse CreateApplicationProxyRule(Models\CreateApplicationProxyRuleRequest $req) 本接口为旧版，如需调用请尽快迁移至新版，详情请参考 [创建四层代理转发规则
](https://cloud.tencent.com/document/product/1552/103416) 。
 * @method Models\CreateCLSIndexResponse CreateCLSIndex(Models\CreateCLSIndexRequest $req) 针对指定实时日志投递任务（task-id），在对应的腾讯云 CLS 日志主题中创建投递日志字段对应的键值索引。如果您在腾讯云 CLS 已经创建索引，本接口将采用合并的方式追加索引。
 * @method Models\CreateConfigGroupVersionResponse CreateConfigGroupVersion(Models\CreateConfigGroupVersionRequest $req) 在版本管理模式下，用于创建指定配置组的新版本。版本管理功能内测中，当前仅白名单开放。
 * @method Models\CreateCustomizeErrorPageResponse CreateCustomizeErrorPage(Models\CreateCustomizeErrorPageRequest $req) 创建自定义错误页面。
 * @method Models\CreateL4ProxyResponse CreateL4Proxy(Models\CreateL4ProxyRequest $req) 用于创建四层代理实例。
 * @method Models\CreateL4ProxyRulesResponse CreateL4ProxyRules(Models\CreateL4ProxyRulesRequest $req) 用于创建四层代理实例规则，支持单条或者批量创建。
 * @method Models\CreateOriginGroupResponse CreateOriginGroup(Models\CreateOriginGroupRequest $req) 创建源站组，以源站组的方式管理业务源站。此处配置的源站组可于**添加加速域名**和**四层代理**等功能中引用。
 * @method Models\CreatePlanResponse CreatePlan(Models\CreatePlanRequest $req) 若您需要使用 Edgeone 产品，您需要通过此接口创建计费套餐。
> 创建套餐后，您需要通过 [CreateZone](https://cloud.tencent.com/document/product/1552/80719) 完成创建站点，绑定套餐的流程，Edgeone 才能正常提供服务。
 * @method Models\CreatePlanForZoneResponse CreatePlanForZone(Models\CreatePlanForZoneRequest $req) 为未购买套餐的站点购买套餐
 * @method Models\CreatePrefetchTaskResponse CreatePrefetchTask(Models\CreatePrefetchTaskRequest $req) 创建预热任务
 * @method Models\CreatePurgeTaskResponse CreatePurgeTask(Models\CreatePurgeTaskRequest $req) 当源站资源更新，但节点缓存 TTL 未过期时，用户仍会访问到旧的资源，此时可以通过该接口实现节点资源更新。触发更新的方法有以下两种：<li>直接删除：不做任何校验，直接删除节点缓存，用户请求时触发回源拉取；</li><li>标记过期：将节点资源置为过期，用户请求时触发回源校验，即发送带有 If-None-Match 和 If-Modified-Since 头部的 HTTP 条件请求。若源站响应 200，则节点会回源拉取新的资源并更新缓存；若源站响应 304，则节点不会更新缓存；</li>

清除缓存任务详情请查看[清除缓存](https://cloud.tencent.com/document/product/1552/70759)。
 * @method Models\CreateRealtimeLogDeliveryTaskResponse CreateRealtimeLogDeliveryTask(Models\CreateRealtimeLogDeliveryTaskRequest $req) 通过本接口创建实时日志投递任务。本接口有如下限制：
同一个实体（七层域名或者四层代理实例）在同种数据投递类型（LogType）和数据投递区域（Area）的组合下，只能被添加到一个实时日志投递任务中。建议先通过 [DescribeRealtimeLogDeliveryTasks](https://cloud.tencent.com/document/product/1552/104110)  接口根据实体查询实时日志投递任务列表，检查实体是否已经被添加到另一实时日志投递任务中。
 * @method Models\CreateRuleResponse CreateRule(Models\CreateRuleRequest $req) 规则引擎创建规则。
 * @method Models\CreateSecurityIPGroupResponse CreateSecurityIPGroup(Models\CreateSecurityIPGroupRequest $req) 创建安全 IP 组
 * @method Models\CreateSharedCNAMEResponse CreateSharedCNAME(Models\CreateSharedCNAMERequest $req) 用于创建共享 CNAME，该功能白名单内测中。
 * @method Models\CreateZoneResponse CreateZone(Models\CreateZoneRequest $req) EdgeOne 为您提供 CNAME、NS 和无域名接入三种接入方式，您需要先通过此接口完成站点创建。CNAME 和 NS 接入站点的场景可参考 [从零开始快速接入 EdgeOne](https://cloud.tencent.com/document/product/1552/87601); 无域名接入的场景可参考 [快速启用四层代理服务](https://cloud.tencent.com/document/product/1552/96051)。

> 建议您在账号下已存在套餐时调用本接口创建站点，请在入参时传入 PlanId ，直接将站点绑定至该套餐；不传入 PlanId 时，创建出来的站点会处于未激活状态，无法正常服务，您需要通过 [BindZoneToPlan](https://cloud.tencent.com/document/product/1552/83042) 完成套餐绑定之后，站点才可正常提供服务 。若您当前没有可绑定的套餐时，请前往控制台购买套餐完成站点创建。
 * @method Models\DeleteAccelerationDomainsResponse DeleteAccelerationDomains(Models\DeleteAccelerationDomainsRequest $req) 批量删除加速域名
 * @method Models\DeleteAliasDomainResponse DeleteAliasDomain(Models\DeleteAliasDomainRequest $req) 删除别称域名。
 * @method Models\DeleteApplicationProxyResponse DeleteApplicationProxy(Models\DeleteApplicationProxyRequest $req) 本接口为旧版，如需调用请尽快迁移至新版，详情请参考 [删除四层代理实例
](https://cloud.tencent.com/document/product/1552/103415) 。
 * @method Models\DeleteApplicationProxyRuleResponse DeleteApplicationProxyRule(Models\DeleteApplicationProxyRuleRequest $req) 本接口为旧版，如需调用请尽快迁移至新版，详情请参考 [删除四层代理转发规则](https://cloud.tencent.com/document/product/1552/103414) 。
 * @method Models\DeleteCustomErrorPageResponse DeleteCustomErrorPage(Models\DeleteCustomErrorPageRequest $req) 删除自定义错误页面。
 * @method Models\DeleteL4ProxyResponse DeleteL4Proxy(Models\DeleteL4ProxyRequest $req) 用于删除四层代理实例。
 * @method Models\DeleteL4ProxyRulesResponse DeleteL4ProxyRules(Models\DeleteL4ProxyRulesRequest $req) 用于删除四层代理转发规则，支持单条或者批量操作。
 * @method Models\DeleteOriginGroupResponse DeleteOriginGroup(Models\DeleteOriginGroupRequest $req) 删除源站组，若源站组仍然被服务（例如：四层代理，域名服务，负载均衡，规则引起）引用，将不允许删除。
 * @method Models\DeleteRealtimeLogDeliveryTaskResponse DeleteRealtimeLogDeliveryTask(Models\DeleteRealtimeLogDeliveryTaskRequest $req) 通过本接口删除实时日志投递任务。
 * @method Models\DeleteRulesResponse DeleteRules(Models\DeleteRulesRequest $req) 批量删除规则引擎规则。
 * @method Models\DeleteSecurityIPGroupResponse DeleteSecurityIPGroup(Models\DeleteSecurityIPGroupRequest $req) 删除指定 IP 组，如果有规则引用了 IP 组情况，则不允许删除。
 * @method Models\DeleteSharedCNAMEResponse DeleteSharedCNAME(Models\DeleteSharedCNAMERequest $req) 用于删除共享 CNAME，该功能白名单内测中。
 * @method Models\DeleteZoneResponse DeleteZone(Models\DeleteZoneRequest $req) 删除站点。
 * @method Models\DeployConfigGroupVersionResponse DeployConfigGroupVersion(Models\DeployConfigGroupVersionRequest $req) 在版本管理模式下，用于版本发布，可通过 EnvId 将版本发布至测试环境或生产环境。版本管理功能内测中，当前仅白名单开放。
 * @method Models\DescribeAccelerationDomainsResponse DescribeAccelerationDomains(Models\DescribeAccelerationDomainsRequest $req) 您可以通过本接口查看站点下的域名信息，包括加速域名、源站以及域名状态等信息。您可以查看站点下全部域名的信息，也可以指定过滤条件查询对应的域名信息。
 * @method Models\DescribeAliasDomainsResponse DescribeAliasDomains(Models\DescribeAliasDomainsRequest $req) 查询别称域名信息列表。
 * @method Models\DescribeApplicationProxiesResponse DescribeApplicationProxies(Models\DescribeApplicationProxiesRequest $req) 本接口为旧版，如需调用请尽快迁移至新版，新版接口中将四层代理实例列表的查询和四层转发规则的查询拆分成两个接口，详情请参考 [查询四层代理实例列表](https://cloud.tencent.com/document/product/1552/103413) 和 [查询四层代理转发规则列表](https://cloud.tencent.com/document/product/1552/103412)。
 * @method Models\DescribeAvailablePlansResponse DescribeAvailablePlans(Models\DescribeAvailablePlansRequest $req) 查询当前账户可用套餐信息列表
 * @method Models\DescribeBillingDataResponse DescribeBillingData(Models\DescribeBillingDataRequest $req) 通过本接口查询计费数据。
 * @method Models\DescribeConfigGroupVersionDetailResponse DescribeConfigGroupVersionDetail(Models\DescribeConfigGroupVersionDetailRequest $req) 在版本管理模式下，用于获取版本的详细信息，包括版本 ID、描述、状态、创建时间、所属配置组信息以及版本配置文件的内容。版本管理功能内测中，当前仅白名单开放。
 * @method Models\DescribeConfigGroupVersionsResponse DescribeConfigGroupVersions(Models\DescribeConfigGroupVersionsRequest $req) 在版本管理模式下，用于查询指定配置组的版本列表。版本管理功能内测中，当前仅白名单开放。
 * @method Models\DescribeContentQuotaResponse DescribeContentQuota(Models\DescribeContentQuotaRequest $req) 查询内容管理接口配额
 * @method Models\DescribeCustomErrorPagesResponse DescribeCustomErrorPages(Models\DescribeCustomErrorPagesRequest $req) 查询自定义错误页列表。
 * @method Models\DescribeDDoSAttackDataResponse DescribeDDoSAttackData(Models\DescribeDDoSAttackDataRequest $req) 本接口（DescribeDDoSAttackData）用于查询DDoS攻击时序数据。
 * @method Models\DescribeDDoSAttackEventResponse DescribeDDoSAttackEvent(Models\DescribeDDoSAttackEventRequest $req) 本接口（DescribeDDoSAttackEvent）用于查询DDoS攻击事件列表。
 * @method Models\DescribeDDoSAttackTopDataResponse DescribeDDoSAttackTopData(Models\DescribeDDoSAttackTopDataRequest $req) 本接口（DescribeDDoSAttackTopData）用于查询DDoS攻击Top数据。
 * @method Models\DescribeDefaultCertificatesResponse DescribeDefaultCertificates(Models\DescribeDefaultCertificatesRequest $req) 查询默认证书列表
 * @method Models\DescribeDeployHistoryResponse DescribeDeployHistory(Models\DescribeDeployHistoryRequest $req) 在版本管理模式下，用于查询生产/测试环境的版本发布历史。版本管理功能内测中，当前仅白名单开放。
 * @method Models\DescribeEnvironmentsResponse DescribeEnvironments(Models\DescribeEnvironmentsRequest $req) 在版本管理模式下，用于查询环境信息，可获取环境 ID、类型、当前生效版本等。版本管理功能内测中，当前仅白名单开放。
 * @method Models\DescribeHostsSettingResponse DescribeHostsSetting(Models\DescribeHostsSettingRequest $req) 用于查询域名配置信息
 * @method Models\DescribeIPRegionResponse DescribeIPRegion(Models\DescribeIPRegionRequest $req) 该接口可用于查询 IP 是否为 EdgeOne IP。
 * @method Models\DescribeIdentificationsResponse DescribeIdentifications(Models\DescribeIdentificationsRequest $req) 查询站点的验证信息。
 * @method Models\DescribeL4ProxyResponse DescribeL4Proxy(Models\DescribeL4ProxyRequest $req) 用于查询四层代理实例列表。
 * @method Models\DescribeL4ProxyRulesResponse DescribeL4ProxyRules(Models\DescribeL4ProxyRulesRequest $req) 查询四层代理实例下的转发规则列表。
 * @method Models\DescribeOriginGroupResponse DescribeOriginGroup(Models\DescribeOriginGroupRequest $req) 获取源站组列表
 * @method Models\DescribeOriginProtectionResponse DescribeOriginProtection(Models\DescribeOriginProtectionRequest $req) 查询源站防护信息
 * @method Models\DescribeOverviewL7DataResponse DescribeOverviewL7Data(Models\DescribeOverviewL7DataRequest $req) 本接口（DescribeOverviewL7Data）用于查询七层监控类时序流量数据。此接口待废弃，请使用 <a href="https://cloud.tencent.com/document/product/1552/80648">DescribeTimingL7AnalysisData</a> 接口。
 * @method Models\DescribePrefetchTasksResponse DescribePrefetchTasks(Models\DescribePrefetchTasksRequest $req) DescribePrefetchTasks 用于查询预热任务提交历史记录及执行进度，通过 CreatePrefetchTasks 接口提交的任务可通过此接口进行查询。
 * @method Models\DescribePurgeTasksResponse DescribePurgeTasks(Models\DescribePurgeTasksRequest $req) DescribePurgeTasks 用于查询提交的 URL 刷新、目录刷新记录及执行进度，通过 CreatePurgeTasks 接口提交的任务均可通过此接口进行查询。
 * @method Models\DescribeRealtimeLogDeliveryTasksResponse DescribeRealtimeLogDeliveryTasks(Models\DescribeRealtimeLogDeliveryTasksRequest $req) 通过本接口查询实时日志投递任务列表。
 * @method Models\DescribeRulesResponse DescribeRules(Models\DescribeRulesRequest $req) 查询规则引擎规则。
 * @method Models\DescribeRulesSettingResponse DescribeRulesSetting(Models\DescribeRulesSettingRequest $req) 返回规则引擎可应用匹配请求的设置列表及其详细建议配置信息
 * @method Models\DescribeSecurityIPGroupResponse DescribeSecurityIPGroup(Models\DescribeSecurityIPGroupRequest $req) 查询安全 IP 组的配置信息，包括安全 IP 组的 ID、名称和内容。
 * @method Models\DescribeSecurityIPGroupInfoResponse DescribeSecurityIPGroupInfo(Models\DescribeSecurityIPGroupInfoRequest $req) 接口已废弃，将于 2024 年 6 月 30 日停止服务。请使用 [查询安全 IP 组
](https://cloud.tencent.com/document/product/1552/105866) 接口。

查询 IP 组的配置信息，包括 IP 组名称、 IP 组内容、 IP 组归属站点。
 * @method Models\DescribeSecurityTemplateBindingsResponse DescribeSecurityTemplateBindings(Models\DescribeSecurityTemplateBindingsRequest $req) 查询指定策略模板的绑定关系列表。
 * @method Models\DescribeTimingL4DataResponse DescribeTimingL4Data(Models\DescribeTimingL4DataRequest $req) 本接口（DescribeTimingL4Data）用于查询四层时序流量数据列表。
 * @method Models\DescribeTimingL7AnalysisDataResponse DescribeTimingL7AnalysisData(Models\DescribeTimingL7AnalysisDataRequest $req) 本接口（DescribeTimingL7AnalysisData）查询七层数据分析类时序数据。
 * @method Models\DescribeTimingL7CacheDataResponse DescribeTimingL7CacheData(Models\DescribeTimingL7CacheDataRequest $req) 本接口（DescribeTimingL7CacheData）用于查询七层缓存分析时序类流量数据。
 * @method Models\DescribeTopL7AnalysisDataResponse DescribeTopL7AnalysisData(Models\DescribeTopL7AnalysisDataRequest $req) 本接口（DescribeTopL7AnalysisData）用于查询七层流量前topN的数据。
 * @method Models\DescribeTopL7CacheDataResponse DescribeTopL7CacheData(Models\DescribeTopL7CacheDataRequest $req) 本接口（DescribeTopL7CacheData）用于查询七层缓存分析topN流量数据。
 * @method Models\DescribeZoneSettingResponse DescribeZoneSetting(Models\DescribeZoneSettingRequest $req) 用于查询站点的所有配置信息。
 * @method Models\DescribeZonesResponse DescribeZones(Models\DescribeZonesRequest $req) 该接口用于查询您有权限的站点信息。可根据不同查询条件筛选站点。
 * @method Models\DestroyPlanResponse DestroyPlan(Models\DestroyPlanRequest $req) 当您需要停止 Edgeone 套餐的计费，可以通过该接口销毁计费套餐。
> 销毁计费套餐需要满足以下条件：
    1.套餐已过期（企业版套餐除外）；
    2.套餐下所有站点均已关闭或删除。

> 站点状态可以通过 [查询站点列表](https://cloud.tencent.com/document/product/1552/80713) 接口进行查询
停用站点可以通过 [切换站点状态](https://cloud.tencent.com/document/product/1552/80707) 接口将站点切换至关闭状态
删除站点可以通过 [删除站点](https://cloud.tencent.com/document/product/1552/80717) 接口将站点删除
 * @method Models\DownloadL4LogsResponse DownloadL4Logs(Models\DownloadL4LogsRequest $req) 本接口（DownloadL4Logs）用于下载四层离线日志。
 * @method Models\DownloadL7LogsResponse DownloadL7Logs(Models\DownloadL7LogsRequest $req) 本接口（DownloadL7Logs）下载七层离线日志。
 * @method Models\IdentifyZoneResponse IdentifyZone(Models\IdentifyZoneRequest $req) 用于验证站点所有权。
 * @method Models\IncreasePlanQuotaResponse IncreasePlanQuota(Models\IncreasePlanQuotaRequest $req) 当您的套餐绑定的站点数，或配置的 Web 防护 - 自定义规则 - 精准匹配策略的规则数，或 Web 防护 - 速率限制 - 精准速率限制模块的规则数达到套餐允许的配额上限，可以通过该接口增购对应配额。
> 该接口该仅支持企业版套餐。
 * @method Models\ModifyAccelerationDomainResponse ModifyAccelerationDomain(Models\ModifyAccelerationDomainRequest $req) 修改加速域名信息
 * @method Models\ModifyAccelerationDomainStatusesResponse ModifyAccelerationDomainStatuses(Models\ModifyAccelerationDomainStatusesRequest $req) 批量修改加速域名状态
 * @method Models\ModifyAliasDomainResponse ModifyAliasDomain(Models\ModifyAliasDomainRequest $req) 修改别称域名。
 * @method Models\ModifyAliasDomainStatusResponse ModifyAliasDomainStatus(Models\ModifyAliasDomainStatusRequest $req) 修改别称域名状态。
 * @method Models\ModifyApplicationProxyResponse ModifyApplicationProxy(Models\ModifyApplicationProxyRequest $req) 本接口为旧版，如需调用请尽快迁移至新版，详情请参考 [修改四层代理实例
](https://cloud.tencent.com/document/product/1552/103411) 。
 * @method Models\ModifyApplicationProxyRuleResponse ModifyApplicationProxyRule(Models\ModifyApplicationProxyRuleRequest $req) 本接口为旧版，如需调用请尽快迁移至新版，详情请参考 [修改四层代理转发规则
](https://cloud.tencent.com/document/product/1552/103410) 。
 * @method Models\ModifyApplicationProxyRuleStatusResponse ModifyApplicationProxyRuleStatus(Models\ModifyApplicationProxyRuleStatusRequest $req) 本接口为旧版，如需调用请尽快迁移至新版，详情请参考 [修改四层代理转发规则状态
](https://cloud.tencent.com/document/product/1552/103409) 。
 * @method Models\ModifyApplicationProxyStatusResponse ModifyApplicationProxyStatus(Models\ModifyApplicationProxyStatusRequest $req) 本接口为旧版，如需调用请尽快迁移至新版，详情请参考 [修改四层代理实例状态](https://cloud.tencent.com/document/product/1552/103408) 。
 * @method Models\ModifyCustomErrorPageResponse ModifyCustomErrorPage(Models\ModifyCustomErrorPageRequest $req) 修改自定义错误页面。
 * @method Models\ModifyHostsCertificateResponse ModifyHostsCertificate(Models\ModifyHostsCertificateRequest $req) 完成域名创建之后，您可以为域名配置自有证书，也可以使用 EdgeOne 为您提供的 [免费证书](https://cloud.tencent.com/document/product/1552/90437)。
如果您需要配置自有证书，请先将证书上传至 [SSL证书控制台](https://console.cloud.tencent.com/certoverview)，然后在本接口中传入对应的证书 ID。详情参考 [部署自有证书至 EdgeOne 域名
](https://cloud.tencent.com/document/product/1552/88874)。
 * @method Models\ModifyL4ProxyResponse ModifyL4Proxy(Models\ModifyL4ProxyRequest $req) 用于修改四层代理实例的配置。
 * @method Models\ModifyL4ProxyRulesResponse ModifyL4ProxyRules(Models\ModifyL4ProxyRulesRequest $req) 用于修改四层代理转发规则，支持单条或者批量修改。
 * @method Models\ModifyL4ProxyRulesStatusResponse ModifyL4ProxyRulesStatus(Models\ModifyL4ProxyRulesStatusRequest $req) 用于启用/停用四层代理转发规则状态，支持单条或者批量操作。
 * @method Models\ModifyL4ProxyStatusResponse ModifyL4ProxyStatus(Models\ModifyL4ProxyStatusRequest $req) 用于启用/停用四层代理实例。
 * @method Models\ModifyOriginGroupResponse ModifyOriginGroup(Models\ModifyOriginGroupRequest $req) 修改源站组配置，新提交的源站记录将会覆盖原有源站组中的源站记录。
 * @method Models\ModifyPlanResponse ModifyPlan(Models\ModifyPlanRequest $req) 修改套餐配置。目前仅支持修改预付费套餐的自动续费开关。
 * @method Models\ModifyRealtimeLogDeliveryTaskResponse ModifyRealtimeLogDeliveryTask(Models\ModifyRealtimeLogDeliveryTaskRequest $req) 通过本接口修改实时日志投递任务配置。本接口有如下限制：<li>不支持修改实时日志投递任务目的地类型（TaskType）；</li><li>不支持修改数据投递类型（LogType）</li><li>不支持修改数据投递区域（Area）</li><li>当原实时日志投递任务的目的地为腾讯云 CLS 时，不支持修改目的地详细配置，如日志集、日志主题。</li>
 * @method Models\ModifyRuleResponse ModifyRule(Models\ModifyRuleRequest $req) 修改规则引擎规则。
 * @method Models\ModifySecurityIPGroupResponse ModifySecurityIPGroup(Models\ModifySecurityIPGroupRequest $req) 修改安全 IP 组。
 * @method Models\ModifySecurityPolicyResponse ModifySecurityPolicy(Models\ModifySecurityPolicyRequest $req) 修改Web&Bot安全配置。
 * @method Models\ModifyZoneResponse ModifyZone(Models\ModifyZoneRequest $req) 修改站点信息。
 * @method Models\ModifyZoneSettingResponse ModifyZoneSetting(Models\ModifyZoneSettingRequest $req) 用于修改站点配置
 * @method Models\ModifyZoneStatusResponse ModifyZoneStatus(Models\ModifyZoneStatusRequest $req) 用于开启，关闭站点。
 * @method Models\RenewPlanResponse RenewPlan(Models\RenewPlanRequest $req) 当您的套餐需要延长有效期，可以通过该接口进行续费。套餐续费仅支持个人版，基础版，标准版套餐。
> 费用详情可参考 [套餐费用](https://cloud.tencent.com/document/product/1552/94158)
 * @method Models\UpgradePlanResponse UpgradePlan(Models\UpgradePlanRequest $req) 当您需要使用高等级套餐才拥有的功能，可以通过本接口升级套餐，仅支持个人版，基础版套餐进行升级。
> 不同类型 Edgeone 计费套餐区别参考 [Edgeone计费套餐选型对比](https://cloud.tencent.com/document/product/1552/94165)
计费套餐升级规则以及资费详情参考 [Edgeone计费套餐升配说明](https://cloud.tencent.com/document/product/1552/95291)
如果需要将套餐升级至企业版，请 [联系我们](https://cloud.tencent.com/online-service)
 * @method Models\VerifyOwnershipResponse VerifyOwnership(Models\VerifyOwnershipRequest $req) 在 CNAME 接入模式下，您需要对站点或者域名的归属权进行验证，可以通过本接口触发验证。若站点通过归属权验证后，后续添加域名无需再验证。详情参考 [站点/域名归属权验证](https://cloud.tencent.com/document/product/1552/70789)。

在 NS 接入模式下，您也可以通过本接口来查询 NS 服务器是否切换成功，详情参考 [修改 DNS 服务器](https://cloud.tencent.com/document/product/1552/90452)。
 */

class TeoClient extends AbstractClient
{
    /**
     * @var string
     */
    protected $endpoint = "teo.tencentcloudapi.com";

    /**
     * @var string
     */
    protected $service = "teo";

    /**
     * @var string
     */
    protected $version = "2022-09-01";

    /**
     * @param Credential $credential
     * @param string $region
     * @param ClientProfile|null $profile
     * @throws TencentCloudSDKException
     */
    function __construct($credential, $region, $profile=null)
    {
        parent::__construct($this->endpoint, $this->version, $credential, $region, $profile);
    }

    public function returnResponse($action, $response)
    {
        $respClass = "TencentCloud"."\\".ucfirst("teo")."\\"."V20220901\\Models"."\\".ucfirst($action)."Response";
        $obj = new $respClass();
        $obj->deserialize($response);
        return $obj;
    }
}
