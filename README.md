# dx-prober-updater
一个简单的转发api 用于在iOS快捷指令等地方快捷的将舞萌DX的网页导入查分器

框架:ThinkPHP 6

### 抓包工具配合快捷指令导分办法

首先先导入这个[快捷指令](https://www.icloud.com/shortcuts/2fed1005f4014349a990ddcc47fb9f2b)

如果无法导入 请运行一下任意一个快捷指令 再进设置→快捷指令 打开私人共享

然后使用Surge QuantumultX等抓包工具 打开MitM

主机名增加`maimai.wahlap.com`

SSL抓包如何配置请自行百度

配置完毕 并打开抓包后

进入微信 打开"我的记录" 并进入【记录】→【乐曲成绩】→【歌曲类别】

然后选一下你想导入的难度

选择完毕后

在抓包工具内找到

`https://maimai.wahlap.com/maimai-mobile/record/musicGenre/search/?genre=99&diff=3`

这样的地址

然后在响应内选择导出(记得请导出文件格式的网页！！！！ 不要直接导出html的文字) 选择上面提到的"将网页更新至查分器" 然后输入账号密码 即可

## <span id="FAQ">常见问题（FAQ）</span>

> api使用怎么用

`https://prober.jinale.com/diving-fish/updateRecord` 使用POST直接把username password 和file传进去即可

file是你的网页本身

### Disclaimer

本传分器与华立、SEGA 等公司无任何关系，注册商标所有权归相关品牌所有。请勿使用本代码用于网络攻击或其他滥用行为。
