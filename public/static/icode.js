const useStorage = () => {
    /**
     * 设置储存数据
     * @param key 键
     * @param data 值
     * @param expire 过期时间（秒）
     * @returns Promise
     */
    const set = (key, data, expire) => {
        return new Promise((resolve, reject) => {
            const obj = {
                expire: 0,
                data: data,
            }
            if (expire !== undefined) {
                obj.expire = Date.now() + expire * 1000
            }
            globalThis.localStorage.setItem(key, JSON.stringify(obj));
            if (get(key) === null) {
                reject();
            } else {
                resolve(true);
            }
        })
    }
    /**
     * 获取储存数据
     * @param key 键
     * @returns StorageInterface
     */
    const get = (key) => {
        const data = globalThis.localStorage.getItem(key);

        if (data === null) {
            return null;
        }
        const ret = JSON.parse(data);

        if (ret?.expire > 0 && ret?.expire < Date.now()) {
            return null;
        }
        return ret?.data;
    }
    return { set, get };
}
function icodeRun(){
    // 获取地址栏参数
    const url = new URL(globalThis.location.href);
    const icode = url.searchParams.get('icode');
    const storage = useStorage();
    // 保存到本地存储
    if (icode&&!storage.get('CONTROL.ICODE')) {
        storage.set('CONTROL.ICODE', icode);
        console.log('icode.js loaded')
    }
}
icodeRun()