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

namespace TencentCloud\Billing\V20180709;

use TencentCloud\Common\AbstractClient;
use TencentCloud\Common\Profile\ClientProfile;
use TencentCloud\Common\Credential;
use TencentCloud\Billing\V20180709\Models as Models;

/**
 * @method Models\CreateAllocationTagResponse CreateAllocationTag(Models\CreateAllocationTagRequest $req) 批量设置分账标签
 * @method Models\CreateSavingPlanOrderResponse CreateSavingPlanOrder(Models\CreateSavingPlanOrderRequest $req) 创建节省计划订单，创建订单完成需调用PayDeals接口完成订单支付
 * @method Models\DeleteAllocationTagResponse DeleteAllocationTag(Models\DeleteAllocationTagRequest $req) 批量取消设置分账标签
 * @method Models\DescribeAccountBalanceResponse DescribeAccountBalance(Models\DescribeAccountBalanceRequest $req) 获取云账户余额信息。
 * @method Models\DescribeAllocateConditionsResponse DescribeAllocateConditions(Models\DescribeAllocateConditionsRequest $req) 查询资源目录筛选条件
 * @method Models\DescribeAllocationBillConditionsResponse DescribeAllocationBillConditions(Models\DescribeAllocationBillConditionsRequest $req) 查询分账账单筛选条件
 * @method Models\DescribeAllocationBillDetailResponse DescribeAllocationBillDetail(Models\DescribeAllocationBillDetailRequest $req) 查询分账账单明细
 * @method Models\DescribeAllocationMonthOverviewResponse DescribeAllocationMonthOverview(Models\DescribeAllocationMonthOverviewRequest $req) 查询分账账单月概览
 * @method Models\DescribeAllocationOverviewResponse DescribeAllocationOverview(Models\DescribeAllocationOverviewRequest $req) 查询分账账单日概览
 * @method Models\DescribeAllocationSummaryByBusinessResponse DescribeAllocationSummaryByBusiness(Models\DescribeAllocationSummaryByBusinessRequest $req) 查询分账账单按产品汇总
 * @method Models\DescribeAllocationSummaryByItemResponse DescribeAllocationSummaryByItem(Models\DescribeAllocationSummaryByItemRequest $req) 查询分账账单按组件汇总
 * @method Models\DescribeAllocationSummaryByResourceResponse DescribeAllocationSummaryByResource(Models\DescribeAllocationSummaryByResourceRequest $req) 查询分账账单按资源汇总
 * @method Models\DescribeAllocationTrendByMonthResponse DescribeAllocationTrendByMonth(Models\DescribeAllocationTrendByMonthRequest $req) 查询分账账单费用趋势
 * @method Models\DescribeBillDetailResponse DescribeBillDetail(Models\DescribeBillDetailRequest $req) 获取账单明细数据。
注意事项：
1.在请求接口时，由于网络不稳定或其它异常，可能会导致请求失败。如果您遇到这种情况，我们建议您在接口请求失败时，手动发起重试操作，这样可以更好地确保您的接口请求能够成功执行。
2.对于账单明细数据量级很大（例如每月账单明细量级超过20w）的客户，通过 API 调用账单数据效率较低，建议您开通账单数据存储功能，通过存储桶中获取账单文件进行分析。[账单存储至COS桶](https://cloud.tencent.com/document/product/555/61275)
 * @method Models\DescribeBillDetailForOrganizationResponse DescribeBillDetailForOrganization(Models\DescribeBillDetailForOrganizationRequest $req) 成员账号获取管理账号代付账单（费用明细）。
注意事项：在请求接口时，由于网络不稳定或其它异常，可能会导致请求失败。如果您遇到这种情况，我们建议您在接口请求失败时，手动发起重试操作，这样可以更好地确保您的接口请求能够成功执行。
 * @method Models\DescribeBillDownloadUrlResponse DescribeBillDownloadUrl(Models\DescribeBillDownloadUrlRequest $req) 该接口支持通过传参，获取L0-PDF、L1-汇总、L2-资源、L3-明细、账单包、五类账单文件下载链接
 * @method Models\DescribeBillListResponse DescribeBillList(Models\DescribeBillListRequest $req) 获取收支明细列表，支持翻页和参数过滤
 * @method Models\DescribeBillResourceSummaryResponse DescribeBillResourceSummary(Models\DescribeBillResourceSummaryRequest $req) 获取账单资源汇总数据
 * @method Models\DescribeBillResourceSummaryForOrganizationResponse DescribeBillResourceSummaryForOrganization(Models\DescribeBillResourceSummaryForOrganizationRequest $req) 成员账号获取管理账号代付账单（按资源汇总）
 * @method Models\DescribeBillSummaryResponse DescribeBillSummary(Models\DescribeBillSummaryRequest $req) 该接口支持通过传参，按照产品、项目、地域、计费模式和标签五个维度获取账单费用明细。
 * @method Models\DescribeBillSummaryByPayModeResponse DescribeBillSummaryByPayMode(Models\DescribeBillSummaryByPayModeRequest $req) 获取按计费模式汇总费用分布
 * @method Models\DescribeBillSummaryByProductResponse DescribeBillSummaryByProduct(Models\DescribeBillSummaryByProductRequest $req) 获取产品汇总费用分布
 * @method Models\DescribeBillSummaryByProjectResponse DescribeBillSummaryByProject(Models\DescribeBillSummaryByProjectRequest $req) 获取按项目汇总费用分布
 * @method Models\DescribeBillSummaryByRegionResponse DescribeBillSummaryByRegion(Models\DescribeBillSummaryByRegionRequest $req) 获取按地域汇总费用分布
 * @method Models\DescribeBillSummaryByTagResponse DescribeBillSummaryByTag(Models\DescribeBillSummaryByTagRequest $req) 获取按标签汇总费用分布
 * @method Models\DescribeBillSummaryForOrganizationResponse DescribeBillSummaryForOrganization(Models\DescribeBillSummaryForOrganizationRequest $req) 该接口支持通过传参，按照产品、项目、地域、计费模式和标签五个维度获取账单费用明细。
 * @method Models\DescribeCostDetailResponse DescribeCostDetail(Models\DescribeCostDetailRequest $req) 查询消耗明细
 * @method Models\DescribeCostExplorerSummaryResponse DescribeCostExplorerSummary(Models\DescribeCostExplorerSummaryRequest $req) 查看成本分析明细
 * @method Models\DescribeCostSummaryByProductResponse DescribeCostSummaryByProduct(Models\DescribeCostSummaryByProductRequest $req) 获取按产品汇总消耗详情
 * @method Models\DescribeCostSummaryByProjectResponse DescribeCostSummaryByProject(Models\DescribeCostSummaryByProjectRequest $req) 获取按项目汇总消耗详情
 * @method Models\DescribeCostSummaryByRegionResponse DescribeCostSummaryByRegion(Models\DescribeCostSummaryByRegionRequest $req) 获取按地域汇总消耗详情
 * @method Models\DescribeCostSummaryByResourceResponse DescribeCostSummaryByResource(Models\DescribeCostSummaryByResourceRequest $req) 获取按资源汇总消耗详情
 * @method Models\DescribeDealsByCondResponse DescribeDealsByCond(Models\DescribeDealsByCondRequest $req) 查询订单
 * @method Models\DescribeDosageCosDetailByDateResponse DescribeDosageCosDetailByDate(Models\DescribeDosageCosDetailByDateRequest $req) 获取COS产品用量明细
 * @method Models\DescribeDosageDetailByDateResponse DescribeDosageDetailByDate(Models\DescribeDosageDetailByDateRequest $req) 按日期获取产品用量明细
 * @method Models\DescribeDosageDetailListResponse DescribeDosageDetailList(Models\DescribeDosageDetailListRequest $req) 获取已接入标准用量明细模板产品的用量明细数据，目前已接入并支持查询的产品包括：云联络中心、实时音视频、实时音视频、智能媒资托管、CODING DevOps、全球IP应用加速
 * @method Models\DescribeGatherResourceResponse DescribeGatherResource(Models\DescribeGatherResourceRequest $req) 查询分账账单资源归集汇总
 * @method Models\DescribeSavingPlanCoverageResponse DescribeSavingPlanCoverage(Models\DescribeSavingPlanCoverageRequest $req) 查询当前用户节省计划覆盖率明细数据，如无特别说明，金额单位均为元（国内站）或者美元（国际站）。
 * @method Models\DescribeSavingPlanOverviewResponse DescribeSavingPlanOverview(Models\DescribeSavingPlanOverviewRequest $req) 查用当前用户明细节省计划总览查询时段内的使用情况
 * @method Models\DescribeSavingPlanResourceInfoResponse DescribeSavingPlanResourceInfo(Models\DescribeSavingPlanResourceInfoRequest $req) 查询节省计划详情
 * @method Models\DescribeSavingPlanUsageResponse DescribeSavingPlanUsage(Models\DescribeSavingPlanUsageRequest $req) 查用当前用户明细节省计划查询时段内的使用情况
 * @method Models\DescribeTagListResponse DescribeTagList(Models\DescribeTagListRequest $req) 获取分账标签
 * @method Models\DescribeVoucherInfoResponse DescribeVoucherInfo(Models\DescribeVoucherInfoRequest $req) 获取代金券相关信息
 * @method Models\DescribeVoucherUsageDetailsResponse DescribeVoucherUsageDetails(Models\DescribeVoucherUsageDetailsRequest $req) 获取代金券使用记录
 * @method Models\PayDealsResponse PayDeals(Models\PayDealsRequest $req) 支付订单
 */

class BillingClient extends AbstractClient
{
    /**
     * @var string
     */
    protected $endpoint = "billing.tencentcloudapi.com";

    /**
     * @var string
     */
    protected $service = "billing";

    /**
     * @var string
     */
    protected $version = "2018-07-09";

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
        $respClass = "TencentCloud"."\\".ucfirst("billing")."\\"."V20180709\\Models"."\\".ucfirst($action)."Response";
        $obj = new $respClass();
        $obj->deserialize($response);
        return $obj;
    }
}
